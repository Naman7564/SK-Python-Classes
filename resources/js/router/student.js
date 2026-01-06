import { createRouter, createWebHistory } from 'vue-router';
import StudentPanel from '../components/StudentPanel.vue';
import Dashboard from '../components/student/Dashboard.vue';
import LiveClasses from '../components/student/LiveClasses.vue';
import Payments from '../components/student/Payments.vue';
import Certificates from '../components/student/Certificates.vue';

const routes = [
    {
        path: '/dashboard',
        component: StudentPanel,
        redirect: '/dashboard',
        children: [
            {
                path: '',
                name: 'student.dashboard',
                component: Dashboard,
                meta: { title: 'Dashboard', subtitle: 'Your learning overview' }
            },
            {
                path: 'live-classes',
                name: 'student.live-classes',
                component: LiveClasses,
                meta: { title: 'Live Classes', subtitle: 'View and join your classes' }
            },
            {
                path: 'payments',
                name: 'student.payments',
                component: Payments,
                meta: { title: 'Payments', subtitle: 'View your payment history' }
            },
            {
                path: 'certificates',
                name: 'student.certificates',
                component: Certificates,
                meta: { title: 'Certificates', subtitle: 'View and download certificates' }
            }
        ]
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition;
        } else {
            return { top: 0, behavior: 'smooth' };
        }
    }
});

export default router;

