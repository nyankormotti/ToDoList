<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChangePassMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username,$password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('info@info.com') // 送信元
            ->subject('【パスワード変更】変更パスワードの連絡') // メールタイトル
            ->view('mail.changePassMail') // どのテンプレートを呼び出すか
            ->with(['username' => $this->username,'password' => $this->password]); // withオプションでセットしたデータをテンプレートへ受け渡す
    }
}
