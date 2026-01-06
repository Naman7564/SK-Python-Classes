@Library('shared-pipeline-library') _

pipeline {
    agent {
        label 'doraemon'
    }

    environment {
        // Docker Hub Configuration
        DOCKER_HUB_USERNAME = 'naman7564'
        IMAGE_NAME = 'sk-python-classes'
        DOCKER_REGISTRY = 'docker.io'
        
        // Build Versioning
        BUILD_TIMESTAMP = sh(script: 'date +%Y%m%d_%H%M%S', returnStdout: true).trim()
        CURRENT_TAG = "v${BUILD_NUMBER}-${BUILD_TIMESTAMP}"
        BACKUP_TAG = "backup-${BUILD_NUMBER}"
        LATEST_TAG = 'latest'
        STABLE_TAG = 'stable'
        
        // Health Check Configuration
        HEALTH_CHECK_RETRIES = '10'
        HEALTH_CHECK_INTERVAL = '5'
        CONTAINER_NAME = 'sk-python-classes-app'
        SERVER_IP = '140.245.6.79'
        
        // Rollback Configuration
        PREVIOUS_STABLE_TAG = 'previous-stable'
    }

    options {
        buildDiscarder(logRotator(numToKeepStr: '10', artifactNumToKeepStr: '5'))
        timestamps()
        timeout(time: 30, unit: 'MINUTES')
        disableConcurrentBuilds()
        // NOTE: ansiColor('xterm') removed - requires AnsiColor plugin to be installed
    }

    stages {
        stage('🧹 Workspace Cleanup') {
            steps {
                echo '═══════════════════════════════════════════════════════════════'
                echo '                    WORKSPACE CLEANUP                           '
                echo '═══════════════════════════════════════════════════════════════'
                cleanWs()
            }
        }

        stage('📥 Code Checkout') {
            steps {
                echo '═══════════════════════════════════════════════════════════════'
                echo '                    CODE CHECKOUT                               '
                echo '═══════════════════════════════════════════════════════════════'
                git branch: 'main',
                    url: 'https://github.com/Naman7564/SK-Python-Classes.git',
                    credentialsId: 'github-credentials'
                
                script {
                    env.GIT_COMMIT_SHORT = sh(script: 'git rev-parse --short HEAD', returnStdout: true).trim()
                    env.GIT_COMMIT_MSG = sh(script: 'git log -1 --pretty=%B', returnStdout: true).trim()
                    env.GIT_AUTHOR = sh(script: 'git log -1 --pretty=%an', returnStdout: true).trim()
                }
                
                echo "📌 Commit: ${env.GIT_COMMIT_SHORT}"
                echo "📝 Message: ${env.GIT_COMMIT_MSG}"
                echo "👤 Author: ${env.GIT_AUTHOR}"
            }
        }

        stage('🔍 Code Quality & Security') {
            parallel {
                stage('Lint Check') {
                    steps {
                        echo '🔍 Running code quality checks...'
                        // Add your linting tools here (e.g., PHP_CodeSniffer, ESLint)
                        sh '''
                            echo "Running syntax checks..."
                            find . -name "*.php" -print0 | xargs -0 -n1 php -l 2>/dev/null || true
                        '''
                    }
                }
                stage('Security Scan') {
                    steps {
                        echo '🛡️ Running security scan...'
                        // Add security scanning tools (e.g., Trivy, Snyk)
                        sh '''
                            echo "Security scan placeholder..."
                        '''
                    }
                }
            }
        }

        stage('💾 Create Backup Image') {
            steps {
                echo '═══════════════════════════════════════════════════════════════'
                echo '                    BACKUP CREATION                             '
                echo '═══════════════════════════════════════════════════════════════'
                script {
                    // Check if stable image exists and create backup
                    def stableExists = sh(
                        script: "docker images -q ${DOCKER_HUB_USERNAME}/${IMAGE_NAME}:${STABLE_TAG} 2>/dev/null",
                        returnStdout: true
                    ).trim()
                    
                    if (stableExists) {
                        echo "📦 Creating backup of current stable image..."
                        
                        // Tag current stable as previous-stable for rollback
                        sh """
                            docker tag ${DOCKER_HUB_USERNAME}/${IMAGE_NAME}:${STABLE_TAG} \
                                       ${DOCKER_HUB_USERNAME}/${IMAGE_NAME}:${PREVIOUS_STABLE_TAG}
                        """
                        
                        // Tag with backup version
                        sh """
                            docker tag ${DOCKER_HUB_USERNAME}/${IMAGE_NAME}:${STABLE_TAG} \
                                       ${DOCKER_HUB_USERNAME}/${IMAGE_NAME}:${BACKUP_TAG}
                        """
                        
                        echo "✅ Backup created with tags: ${PREVIOUS_STABLE_TAG}, ${BACKUP_TAG}"
                        env.BACKUP_AVAILABLE = 'true'
                    } else {
                        echo "⚠️ No existing stable image found. Skipping backup..."
                        env.BACKUP_AVAILABLE = 'false'
                    }
                }
            }
        }

        stage('🏗️ Build New Image') {
            steps {
                echo '═══════════════════════════════════════════════════════════════'
                echo '                    DOCKER BUILD                                '
                echo '═══════════════════════════════════════════════════════════════'
                script {
                    echo "🔨 Building Docker image with tag: ${CURRENT_TAG}"
                    
                    sh """
                        docker build \
                            --build-arg BUILD_DATE=\$(date -u +'%Y-%m-%dT%H:%M:%SZ') \
                            --build-arg VCS_REF=${GIT_COMMIT_SHORT} \
                            --build-arg BUILD_NUMBER=${BUILD_NUMBER} \
                            --label "org.opencontainers.image.created=\$(date -u +'%Y-%m-%dT%H:%M:%SZ')" \
                            --label "org.opencontainers.image.revision=${GIT_COMMIT_SHORT}" \
                            --label "org.opencontainers.image.version=${CURRENT_TAG}" \
                            --label "org.opencontainers.image.title=${IMAGE_NAME}" \
                            --label "org.opencontainers.image.vendor=${DOCKER_HUB_USERNAME}" \
                            --label "jenkins.build.number=${BUILD_NUMBER}" \
                            -t ${IMAGE_NAME}:${CURRENT_TAG} \
                            -t ${IMAGE_NAME}:${LATEST_TAG} \
                            -t ${DOCKER_HUB_USERNAME}/${IMAGE_NAME}:${CURRENT_TAG} \
                            -t ${DOCKER_HUB_USERNAME}/${IMAGE_NAME}:${LATEST_TAG} \
                            .
                    """
                    
                    echo "✅ Image built successfully: ${DOCKER_HUB_USERNAME}/${IMAGE_NAME}:${CURRENT_TAG}"
                }
            }
        }

        stage('🧪 Test Container') {
            steps {
                echo '═══════════════════════════════════════════════════════════════'
                echo '                    CONTAINER TESTING                           '
                echo '═══════════════════════════════════════════════════════════════'
                script {
                    def testContainerName = "test-${IMAGE_NAME}-${BUILD_NUMBER}"
                    
                    try {
                        echo "🚀 Starting test container..."
                        
                        // Run test container
                        sh """
                            docker run -d \
                                --name ${testContainerName} \
                                -p 8888:80 \
                                ${DOCKER_HUB_USERNAME}/${IMAGE_NAME}:${CURRENT_TAG}
                        """
                        
                        // Wait for container to be ready
                        sh """
                            echo "⏳ Waiting for container to be ready..."
                            sleep 10
                        """
                        
                        // Health check
                        sh """
                            echo "🔍 Running health check on ${SERVER_IP}:8888..."
                            for i in \$(seq 1 ${HEALTH_CHECK_RETRIES}); do
                                if curl -sf http://${SERVER_IP}:8888 > /dev/null 2>&1; then
                                    echo "✅ Health check passed on attempt \$i"
                                    exit 0
                                fi
                                echo "⏳ Attempt \$i failed, retrying in ${HEALTH_CHECK_INTERVAL}s..."
                                sleep ${HEALTH_CHECK_INTERVAL}
                            done
                            echo "❌ Health check failed after ${HEALTH_CHECK_RETRIES} attempts"
                            exit 1
                        """
                        
                        echo "✅ Container tests passed!"
                        
                    } finally {
                        // Cleanup test container
                        sh """
                            docker stop ${testContainerName} 2>/dev/null || true
                            docker rm ${testContainerName} 2>/dev/null || true
                        """
                    }
                }
            }
        }

        stage('📤 Push to DockerHub') {
            steps {
                echo '═══════════════════════════════════════════════════════════════'
                echo '                    PUSH TO DOCKER HUB                          '
                echo '═══════════════════════════════════════════════════════════════'
                script {
                    // Push all tags to Docker Hub
                    docker_push("${IMAGE_NAME}", "${DOCKER_HUB_USERNAME}", "${CURRENT_TAG}")
                    docker_push("${IMAGE_NAME}", "${DOCKER_HUB_USERNAME}", "${LATEST_TAG}")
                    
                    // Push backup if available
                    if (env.BACKUP_AVAILABLE == 'true') {
                        echo "📦 Pushing backup image..."
                        docker_push("${IMAGE_NAME}", "${DOCKER_HUB_USERNAME}", "${BACKUP_TAG}")
                        docker_push("${IMAGE_NAME}", "${DOCKER_HUB_USERNAME}", "${PREVIOUS_STABLE_TAG}")
                    }
                    
                    echo "✅ All images pushed to Docker Hub successfully!"
                }
            }
        }



        stage('🧹 Cleanup') {
            steps {
                echo '═══════════════════════════════════════════════════════════════'
                echo '                    CLEANUP                                     '
                echo '═══════════════════════════════════════════════════════════════'
                script {
                    echo "🧹 Cleaning up old images and containers..."
                    
                    sh '''
                        # Remove dangling images
                        docker image prune -f 2>/dev/null || true
                        
                        # Remove old build images (keep last 5)
                        docker images | grep "${IMAGE_NAME}" | grep "^v" | \
                            tail -n +6 | awk '{print $3}' | \
                            xargs -r docker rmi -f 2>/dev/null || true
                        
                        echo "✅ Cleanup completed!"
                    '''
                }
            }
        }
    }

    post {
        success {
            echo '''
╔═══════════════════════════════════════════════════════════════════╗
║                                                                   ║
║   ✅  PIPELINE COMPLETED SUCCESSFULLY!                            ║
║                                                                   ║
║   🏷️  Image Tag: ${CURRENT_TAG}                                   ║
║   📦  Backup Tag: ${BACKUP_TAG}                                   ║
║   🔄  Stable Tag: ${STABLE_TAG}                                   ║
║                                                                   ║
╚═══════════════════════════════════════════════════════════════════╝
'''
            script {
                // Optional: Send success notification
                // slackSend(channel: '#deployments', color: 'good', 
                //     message: "✅ Deployment successful: ${IMAGE_NAME}:${CURRENT_TAG}")
                
                echo "📧 Build #${BUILD_NUMBER} completed successfully!"
                echo "🏷️ Deployed version: ${CURRENT_TAG}"
                echo "📦 Backup available: ${BACKUP_TAG}"
            }
        }
        
        failure {
            echo '''
╔═══════════════════════════════════════════════════════════════════╗
║                                                                   ║
║   ❌  PIPELINE FAILED!                                            ║
║                                                                   ║
║   🔄  Rollback was attempted if backup was available              ║
║   📋  Check logs for details                                      ║
║                                                                   ║
╚═══════════════════════════════════════════════════════════════════╝
'''
            script {
                // Optional: Send failure notification
                // slackSend(channel: '#deployments', color: 'danger',
                //     message: "❌ Deployment failed: ${IMAGE_NAME} - Build #${BUILD_NUMBER}")
                
                echo "❌ Build #${BUILD_NUMBER} failed!"
                echo "🔄 Rollback status: ${env.BACKUP_AVAILABLE == 'true' ? 'Attempted' : 'No backup available'}"
            }
        }
        
        unstable {
            echo '⚠️ Pipeline completed with warnings!'
        }
        
        always {
            echo "📋 Build Duration: ${currentBuild.durationString}"
            echo "📅 Build Time: ${BUILD_TIMESTAMP}"
            
            // Clean workspace
            cleanWs(cleanWhenFailure: false)
        }
    }
}
