<?php declare(strict_types=1);

namespace App\Users;

use App\Interfaces\Resettable;
use App\Traits\CanLogin;

/**
 * Customer user. Holds associative cart (productId => quantity) and numeric wishlist (list of IDs).
 */
class CustomerUser extends UserBase implements Resettable
{
    use CanLogin;

    /** @var array<int, int> Associative array: productId => quantity (keyed access by product). */
    private array $shoppingCart = [];

    /** @var list<int> Numeric array: ordered list of wishlist product IDs. */
    private array $wishlistIds = [];

    public function __construct(string $name, string $email)
    {
        parent::__construct($name, $email, self::ROLE_CUSTOMER);
    }

    public function resetPassword(string $newPassword): void
    {
        $this->password = $newPassword;
    }

    /** @return array<int, int> */
    public function getShoppingCart(): array
    {
        return $this->shoppingCart;
    }

    /** @return list<int> */
    public function getWishlistIds(): array
    {
        return $this->wishlistIds;
    }

    public function addToCart(int $productId, int $quantity): void
    {
        $this->shoppingCart[$productId] = ($this->shoppingCart[$productId] ?? 0) + $quantity;
    }

    public function addToWishlist(int $productId): void
    {
        if (!in_array($productId, $this->wishlistIds, true)) {
            $this->wishlistIds[] = $productId;
        }
    }
}