<?php

namespace App\Core;

use App\Models\Admin;

class Session 
{
    private static array $shoppingCart;
    private static int $totalAmount;
    private static float $totalSum;

    public static function start()
    {
        session_start();

        $flashMessages = $_SESSION['flash_messages'] ?? [];
        foreach ($flashMessages as $key => &$message) {
            $message['remove'] = true;
        }
        $_SESSION['flash_messages'] = $flashMessages;

        self::$shoppingCart = $_SESSION['shopping-cart'] ?? [];
        self::$totalAmount = $_SESSION['total-amount'] ?? 0;
        self::$totalSum = $_SESSION['total-sum'] ?? 0;
    }

    public static function setFlashMessage($key, $message)
    {
        $_SESSION['flash_messages'][$key] = [
            'remove' => false,
            'message' => $message
        ];
    }

    public static function getFlashMessage($key)
    {
        return $_SESSION['flash_messages'][$key]['message'] ?? false;
    }

    public static function setLoginData(array $data)
    {
        $_SESSION['login'] = $data['login'];
        $_SESSION['password'] = $data['password'] ?? $_SESSION['password'];
    }

    public static function tryLogin()
    {
        if (!isset($_SESSION['login']) || !isset($_SESSION['password'])) {
            return false;
        }

        $data = [
            'login' => $_SESSION['login'],
            'password' => $_SESSION['password']
        ];

        $admin = new Admin();
        return $admin->verifyLoginData($data);
    }

    public static function logout()
    {
        unset($_SESSION['login']);
        unset($_SESSION['password']);
    }

    public static function addToShoppingCart($meal)
    {
        $mealIndex = -1;
        foreach (self::$shoppingCart as $key => $value) {
            if ($value->id === $meal->id) {
                $mealIndex = $key;
                break;
            }
        }

        if ($mealIndex === -1) {
            $meal->count = 1;
            self::$shoppingCart[] = $meal;
        } else {
            self::$shoppingCart[$mealIndex]->count++;
        }
        
        self::$totalAmount += 1;
        self::$totalSum += $meal->price;
    }

    public static function getShoppingCart()
    {
        return self::$shoppingCart;
    }

    public static function getCartTotalAmount()
    {
        return self::$totalAmount;
    }

    public static function getCartTotalSum()
    {
        return self::$totalSum;
    }

    public static function changeCartCount(array $data)
    {
        foreach (self::$shoppingCart as $key => $value) {
            if ($value->id === $data['id']) {
                $value->count += $data['number'];
                self::$totalAmount += $data['number'];
                self::$totalSum += $data['number'] * $value->price;
                if ($value->count <= 0) {
                    unset(self::$shoppingCart[$key]);
                }
                break;
            }
        }
    }

    public static function deleteCartMeal(int $id)
    {
        foreach (self::$shoppingCart as $key => $value) {
            if ($value->id == $id) {
                self::$totalAmount -= $value->count;
                self::$totalSum -= $value->count * $value->price;
                unset(self::$shoppingCart[$key]);
                break;
            }
        }
    }

    public static function clearCart()
    {
        self::$shoppingCart = [];
        self::$totalAmount = 0;
        self::$totalSum = 0;
    }

    public static function end()
    {
        $flashMessages = $_SESSION['flash_messages'] ?? [];
        foreach ($flashMessages as $key => &$flashMessage) {
            if ($flashMessage['remove']) {
                unset($flashMessages[$key]);
            }
        }
        $_SESSION['flash_messages'] = $flashMessages;
        
        $_SESSION['shopping-cart'] = self::$shoppingCart;
        $_SESSION['total-amount'] = self::$totalAmount;
        $_SESSION['total-sum'] = self::$totalSum;
    }
}