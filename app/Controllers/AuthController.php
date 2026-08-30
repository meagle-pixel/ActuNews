<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\View;
use App\Models\User;
use PDOException;

class AuthController
{
    public function login(): void
    {
        $erreurs = [];
        $email = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $erreurs[] = "Veuillez remplir tous les champs";
            }

            if (empty($erreurs)) {
                try {
                    $user = User::findByEmail($email);

                    if ($user && password_verify($password, $user['user_password'])) {
                        Auth::login($user);

                        header('Location: ' . BASE_URL . '/index.php');
                        exit;
                    } else {
                        $erreurs[] = "Email ou mot de passe incorrect";
                    }
                } catch (PDOException $e) {
                    $erreurs[] = "Erreur : " . $e->getMessage();
                }
            }
        }

        View::render('auth/login', [
            'erreurs' => $erreurs,
            'email' => $email,
        ]);
    }

    public function register(): void
    {
        $erreurs = [];
        $succes = false;
        $nom = '';
        $prenom = '';
        $email = '';
        $mobile = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['lastName'] ?? '');
            $prenom = trim($_POST['firstName'] ?? '');
            $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
            $mobile = trim($_POST['mobile'] ?? '');
            $password = $_POST['password'] ?? '';
            $password2 = $_POST['password2'] ?? '';

            if (empty($nom) || (strlen($nom) < 2) || (strlen($nom) > 50)) {
                $erreurs[] = "Votre nom doit contenir entre 2 et 50 caractères";
            }

            if (empty($prenom) || (strlen($prenom) < 2) || (strlen($prenom) > 50)) {
                $erreurs[] = "Votre prénom doit contenir entre 2 et 50 caractères";
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $erreurs[] = "Email invalide";
            }

            if (empty($password) || strlen($password) < 8) {
                $erreurs[] = "Le mot de passe doit contenir au moins 8 caractères";
            } elseif ($password !== $password2) {
                $erreurs[] = "Les mots de passe doivent correspondre";
            }

            if (empty($erreurs)) {
                try {
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    User::create($nom, $prenom, $email, $mobile, $hash);

                    $succes = true;
                    $nom = $prenom = $email = '';
                } catch (PDOException $e) {
                    if ($e->getCode() == 23000) {
                        $erreurs[] = "Cet email est déjà utilisé";
                    } else {
                        $erreurs[] = "Erreur : " . $e->getMessage();
                    }
                }
            }
        }

        View::render('auth/register', [
            'erreurs' => $erreurs,
            'succes' => $succes,
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'mobile' => $mobile,
        ]);
    }

    public function logout(): void
    {
        Auth::logout();
        header('Location: ' . BASE_URL . '/index.php');
        exit;
    }
}
