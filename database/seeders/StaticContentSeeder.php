<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StaticContent;

class StaticContentSeeder extends Seeder
{
    public function run(): void
    {
        $terms = <<<TEXT
Welcome to RentCollect! These Terms and Conditions ("Terms") govern your use of the RentCollect mobile application and website (collectively, the “Service”) operated by [Your Company Name] (“we,” “us,” or “our”).

1. Acceptance of Terms
By accessing or using RentCollect, you agree to be bound by these Terms. If you do not agree, please do not use our Service.

2. Eligibility
You must be at least 18 years old and able to enter into legally binding contracts to use the Service.

3. Description of Service
RentCollect enables landlords and tenants to manage rent payments, payment history, reminders, and rental agreements digitally.
TEXT;

        $privacy = <<<TEXT
This Privacy Policy explains how RentCollect ("we", "our", or "us") collects, uses, and protects your information.

1. Information We Collect
- Personal Information: Name, email, phone number, and address.
- Payment Information: Details provided to our third-party processors.
- Usage Data: App activity, log data, and device information.

2. How We Use Your Information
- Facilitate rent payments.
- Provide customer support.
- Improve our services.
- Comply with legal obligations.

3. Sharing Your Information
- Payment processors (e.g., Stripe, PayPal).
- Legal authorities if required.
- Service providers under confidentiality agreements.

4. Data Security
We implement appropriate security measures, but no method of transmission over the Internet is 100% secure.
TEXT;

        $contents = [
            ['type' => 'terms', 'content' => $terms],
            ['type' => 'privacy', 'content' => $privacy],
        ];

        foreach ($contents as $content) {
            StaticContent::updateOrCreate(['type' => $content['type']], $content);
        }
    }
}
