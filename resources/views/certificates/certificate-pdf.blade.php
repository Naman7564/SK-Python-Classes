<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Certificate</title>
    <style>
        @page {
            margin: 0;
            size: A4 landscape;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: 'Times New Roman', serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .certificate-container {
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .certificate {
            width: 90%;
            max-width: 1200px;
            background: white;
            padding: 60px;
            border: 20px solid #f4d03f;
            box-shadow: 0 0 30px rgba(0,0,0,0.3);
            position: relative;
        }
        .certificate::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            bottom: 20px;
            border: 3px solid #667eea;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 20px;
        }
        .brand-name {
            font-size: 36px;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 10px;
        }
        .tagline {
            font-size: 18px;
            color: #666;
            margin-bottom: 20px;
        }
        .certificate-title {
            font-size: 48px;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin: 40px 0;
            text-transform: uppercase;
            letter-spacing: 3px;
        }
        .certificate-text {
            text-align: center;
            font-size: 20px;
            color: #333;
            margin: 30px 0;
            line-height: 1.8;
        }
        .student-name {
            font-size: 42px;
            font-weight: bold;
            color: #667eea;
            text-align: center;
            margin: 30px 0;
            text-decoration: underline;
            text-decoration-color: #f4d03f;
            text-decoration-thickness: 3px;
        }
        .course-name {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin: 20px 0;
        }
        .details {
            margin-top: 50px;
            display: flex;
            justify-content: space-around;
            font-size: 16px;
            color: #666;
        }
        .detail-item {
            text-align: center;
        }
        .detail-label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .certificate-number {
            position: absolute;
            bottom: 30px;
            right: 60px;
            font-size: 12px;
            color: #999;
        }
        .signature-section {
            margin-top: 60px;
            display: flex;
            justify-content: space-around;
        }
        .signature {
            text-align: center;
            width: 200px;
        }
        .signature-line {
            border-top: 2px solid #333;
            margin-top: 60px;
            margin-bottom: 10px;
        }
        .signature-name {
            font-weight: bold;
            font-size: 14px;
        }
        .signature-title {
            font-size: 12px;
            color: #666;
        }
        .verification-note {
            position: absolute;
            bottom: 30px;
            left: 60px;
            font-size: 10px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="certificate-container">
        <div class="certificate">
            <div class="header">
                @if($brandSettings && $brandSettings->brand_logo && file_exists(storage_path('app/public/' . $brandSettings->brand_logo)))
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(storage_path('app/public/' . $brandSettings->brand_logo))) }}" alt="Logo" class="logo">
                @endif
                <div class="brand-name">{{ $brandSettings->brand_name ?? 'SK Python Classes' }}</div>
                @if($brandSettings && $brandSettings->tagline)
                    <div class="tagline">{{ $brandSettings->tagline }}</div>
                @endif
            </div>

            <div class="certificate-title">Certificate of Completion</div>

            <div class="certificate-text">
                This is to certify that
            </div>

            <div class="student-name">
                {{ $certificate->user->name }}
            </div>

            <div class="certificate-text">
                has successfully completed the course
            </div>

            <div class="course-name">
                {{ $certificate->course->name }}
            </div>

            <div class="details">
                <div class="detail-item">
                    <div class="detail-label">Issue Date</div>
                    <div>{{ \Carbon\Carbon::parse($certificate->issue_date)->format('F d, Y') }}</div>
                </div>
                @if($certificate->expiry_date)
                <div class="detail-item">
                    <div class="detail-label">Valid Until</div>
                    <div>{{ \Carbon\Carbon::parse($certificate->expiry_date)->format('F d, Y') }}</div>
                </div>
                @endif
            </div>

            <div class="signature-section">
                <div class="signature">
                    <div class="signature-line"></div>
                    <div class="signature-name">Director</div>
                    <div class="signature-title">{{ $brandSettings->brand_name ?? 'SK Python Classes' }}</div>
                </div>
                <div class="signature">
                    <div class="signature-line"></div>
                    <div class="signature-name">Instructor</div>
                    <div class="signature-title">{{ $brandSettings->brand_name ?? 'SK Python Classes' }}</div>
                </div>
            </div>

            <div class="certificate-number">
                Certificate No: {{ $certificate->certificate_number }}
            </div>

            <div class="verification-note">
                Verify at: {{ url('/certificateverify/' . $certificate->certificate_number) }}
            </div>
        </div>
    </div>
</body>
</html>

