<?php

namespace App\Controllers\Admin;

use App\Core\Auth;
use App\Core\View;
use App\Models\User;
use PDOException;

class UserAdminController
{
    public function index(): void
    {
        Auth::requireRole(['admin']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $new_role = $_POST['roles'] ?? 'user';
            $user_id = $_POST['user_id'] ?? null;

            if ($user_id && User::isValidRole($new_role)) {
                try {
                    User::updateRole((int) $user_id, $new_role);
                    header('Location: usersAdmin.php');
                    exit;
                } catch (PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                    return;
                }
            }
        }

        $roles = User::all();

        View::render('admin/users/index', ['roles' => $roles]);
    }
}
