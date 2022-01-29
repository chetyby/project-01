<?php

namespace App\classes;

class Auth
{
    private $pdo;
    private $loginPath;
    private $session;
    public function __construct($pdo, string $loginPath, array &$session)
    {
        $this->pdo = $pdo;
        $this->loginPath = $loginPath;
        $this->session = &$session;
    }

    public function user()
    {

        // if (session_status() === PHP_SESSION_NONE) {
        //     session_start();
        // }
        $id = $this->session['auth'] ?? null;
        if ($id === null) {
            return null;
        }
        $query = $this->pdo->prepare("SELECT * FROM users Where id= ?");
        $query->execute([$id]);
        $user = $query->fetchObject(User::class);
        return $user ?: null;
    }

    public function login(string $username, string $password)
    {
        $query = $this->pdo->prepare("SELECT * FROM users Where username= :username");
        $query->execute(['username' => $username]);
        $user = $query->fetchObject(User::class);
        if ($user === false) {
            return null;
        }

        if ($password == $user->password) {
            var_dump($user->id);
            $this->session['auth'] = $user->id;

            return $user;
        }
        return null;
    }

    public function requireRole(...$roles): void
    {
        $user = $this->user();
        if ($user == null || !in_array($user->role, $roles)) {
            header("Location: {$this->loginPath}?forbid=1");
            exit();
        }
    }
}
