<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
/**
     * Alamat email yang akan muncul sebagai pengirim.
     * GANTI INI:
     */
    public string $fromEmail  = 'algamingtwo@gmail.com';

    /**
     * Nama yang akan muncul sebagai pengirim.
     */
    public string $fromName   = 'Panitia PPDB MTs Cisarua Girang';

    // ... (biarkan properti lain) ...

    /**
     * Protokol pengiriman: mail, sendmail, atau smtp
     */
    public string $protocol = 'smtp'; // Kita pakai SMTP

    /**
     * Path ke Sendmail (abaikan jika pakai smtp)
     */
    public string $mailPath = '/usr/sbin/sendmail';

    /**
     * SMTP Server Hostname
     * GANTI INI (jika pakai provider lain):
     */
    public string $SMTPHost = 'smtp.gmail.com';

    /**
     * SMTP Username (biasanya sama dengan fromEmail)
     * GANTI INI:
     */
    public string $SMTPUser = 'algamingtwo@gmail.com';

    /**
     * SMTP Password (Gunakan App Password 16 digit Anda)
     * GANTI INI:
     */
    public string $SMTPPass = 'jpgc pwcn pesh bebk';

    /**
     * SMTP Port (465 untuk SSL, 587 untuk TLS)
     */
    public int $SMTPPort = 465;

    /**
     * SMTP Timeout (biarkan default)
     */
    public int $SMTPTimeout = 5;

    /**
     * SMTP Keep Alive (biarkan default)
     */
    public bool $SMTPKeepAlive = false;

    /**
     * SMTP Encryption (ssl atau tls)
     * Sesuaikan dengan Port
     */
    public string $SMTPCrypto = 'ssl';

    /**
     * Tipe email, 'text' atau 'html'
     * 'html' agar email bisa di-styling (bold, link, dll)
     */
    public string $mailType = 'html';

    /**
     * Character set (utf-8, iso-8859-1, etc.)
     */
    public string $charset = 'UTF-8';

    /**
     * Whether to validate the email address
     */
    public bool $validate = false;

    /**
     * Email Priority. 1 = highest. 5 = lowest. 3 = normal
     */
    public int $priority = 3;

    /**
     * Newline character. (Use “\r\n” to comply with RFC 822)
     */
    public string $CRLF = "\r\n";

    /**
     * Newline character. (Use “\r\n” to comply with RFC 822)
     */
    public string $newline = "\r\n";

    /**
     * Enable BCC Batch Mode.
     */
    public bool $BCCBatchMode = false;

    /**
     * Number of emails in each BCC batch
     */
    public int $BCCBatchSize = 200;

    /**
     * Enable notify message from server
     */
    public bool $DSN = false;
}
