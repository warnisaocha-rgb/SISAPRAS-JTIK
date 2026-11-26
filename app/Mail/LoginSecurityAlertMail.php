<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LoginSecurityAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user,
        public string $portalLabel,
        public int $attemptCount,
        public int $lockMinutes,
        public string $ipAddress,
        public string $deviceLabel,
        public string $occurredAt,
        public string $portalUrl,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Peringatan Keamanan: Percobaan Masuk Gagal (' . $this->attemptCount . 'x) - SI-SAPRAS JTIK FT UNM',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.login_security_alert',
        );
    }
}
