<?php declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use App\Users\AdminUser;
use App\Users\CustomerUser;

echo "PHP Basics Coding Challenge Demo — Arrays\n\n";

// --- Numeric arrays: ordered lists (IDs, sequence matters). Use when order or index matters. ---
$admin = new AdminUser('Alice', 'alice@example.com');
$tokenIds = $admin->getAccessTokens();  // numeric: [1, 2, 3]

$validTokens = array_filter($tokenIds, fn(int $id): bool => $id > 1);
echo "Numeric array_filter (tokens > 1): " . json_encode(array_values($validTokens)) . "\n";

$doubled = array_map(fn(int $id): int => $id * 2, $admin->getManagedResourceIds());
echo "Numeric array_map (double resource IDs): " . json_encode($doubled) . "\n\n";

// --- Associative arrays: key => value (user record, cart). Use when access by name/key is needed. ---
$customer = new CustomerUser('Bob', 'bob@example.com');
$customer->addToCart(101, 2);
$customer->addToCart(102, 1);
$customer->addToWishlist(201);
$customer->addToWishlist(202);

$userData = $admin->toArray();  // associative: ['name' => ..., 'email' => ..., 'role' => ...]
echo "Associative user toArray(): " . json_encode($userData) . "\n";

$cart = $customer->getShoppingCart();  // associative: productId => quantity
$cartWithQty = array_filter($cart, fn(int $qty): bool => $qty >= 2);
echo "Associative array_filter (cart items qty >= 2): " . json_encode($cartWithQty) . "\n";

// array_column: extract one key from associative rows (e.g. list of roles).
$roles = array_column([$userData], 'role');
echo "Associative array_column (roles): " . json_encode($roles) . "\n\n";

// --- Mixed: list of users → associative per user (array_map over collection). ---
$users = [$admin, $customer];
$listOfAssoc = array_map(fn($u): array => $u->toArray(), $users);
echo "array_map users to associative: " . json_encode($listOfAssoc, JSON_PRETTY_PRINT) . "\n";

$adminsOnly = array_filter($users, fn($u): bool => $u->role === 'ADMIN');
echo "array_filter (admins only) count: " . count($adminsOnly) . "\n";
