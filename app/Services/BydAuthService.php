<?php

namespace App\Services;
use Illuminate\Support\Env;

use Illuminate\Support\Facades\Session;

class BydAuthService
{

    protected $username;
    protected $password;
    protected $groupId;

    protected $loginApi;
    protected $userListApi;

    public function __construct()
    {
        // group id の設定
        $this->groupId = config('services.bydauth.group_id');

        // Login API の URL を設定
        $this->loginApi = config('services.bydauth.login');

        // ユーザーリスト API の URL を設定
        $this->userListApi = config('services.bydauth.users');
    }

    /**
     * ログイン時に使用するユーザー名をセットする
     *
     * @param string $username
     * @return void
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * ログイン時に必要なパスワードをセットする
     *
     * @param string $password
     * @return void
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * ログインする
     *
     * @param string|null $username
     * @param string|null $password
     * @return boolean
     */
    public function attempt(?string $username = null, ?string $password = null): bool
    {
        $username and $this->setUsername($username);
        $password and $this->setPassword($password);

        $result = $this->exec();

        if (is_null($result)) return false;

        // アカウント情報をSessionに格納する
        Session::put('login_user', $result);

        return true;
    }

    /**
     * ログインチェック
     *
     * @return boolean
     */
    public function check(): bool
    {
        return $this->user() !== null;
    }

    /**
     * ログイン情報を取得
     *
     * @return array|null
     */
    public function user(): ?array
    {
        return Session::get('login_user', null);
    }

    /**
     * ログアウト
     *
     * @return void
     */
    public function logout(): void
    {
        Session::forget('login_user');
        Session::save();
    }

    /**
     * ログインを実行する
     *
     * @param string|null $username
     * @param string|null $password
     * @return array|null
     */
    public function exec(?string $username = null, ?string $password = null): ?array
    {
        $username and $this->setUsername($username);
        $password and $this->setPassword($password);

        $authResult = $this->execApi($this->loginApi);

        $authResult = json_decode($authResult, true) ?? ['result' => false];
        if (!$authResult['result']) {
            return null;
        }

        $userList = $this->getUserList();

        return [
            'id' => $authResult['user']['id'],
            'name' => $authResult['user']['name'],
            'email' => $authResult['user']['email'],
            'lv' => $authResult['auth']['lv'],
            'users' => $userList,
        ];
    }

    /**
     * ユーザー（社員）情報の取得
     *
     * @param string|null $username
     * @param string|null $password
     * @return array
     */
    public function getUserList(?string $username = null, ?string $password = null): array
    {
        $username and $this->setUsername($username);
        $password and $this->setPassword($password);

        $userResult = $this->execApi($this->userListApi);
        $userResult = json_decode($userResult, true) ?? ['users' => []];

        $userList = [];
        foreach ($userResult['users'] as $user) {
            $userList[$user['id']] = $user['name'];
        }

        return $userList;
    }

    protected function validate(): bool
    {
        // ユーザー名のバリデーション

        // パスワードのバリデーション

        // グループ ID のバリデーション
        if (!$this->groupId) throw new Exception('社内認証システムのグループ ID が未設定');

        return true;
    }

    /**
     * 認証システムの API 実行
     *
     * @param string $url
     * @return string
     */
    protected function execApi(string $url): string
    {
        $this->validate();

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_POSTFIELDS => [
                'username' => $this->username,
                'password' => $this->password,
                'group_id' => $this->groupId,
            ],
        ]);

        $result = curl_exec($ch);

        return $result;
    }
}
