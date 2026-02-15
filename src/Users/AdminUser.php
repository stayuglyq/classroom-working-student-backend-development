<?php declare(strict_types=1);

namespace App\Users;

/**
 * Admin user. Holds numeric arrays: access tokens (list) and managed resource IDs (ordered list).
 */
class AdminUser extends UserBase
{
    /** @var list<int> Numeric array: ordered list of token IDs (position may matter for revocation order). */
    private array $accessTokens = [1, 2, 3];

    /** @var list<int> Numeric array: resource IDs this admin can manage (order can reflect priority). */
    private array $managedResourceIds = [10, 20, 30];

    public function __construct(string $name, string $email)
    {
        parent::__construct($name, $email, self::ROLE_ADMIN);
    }

    /** @return list<int> */
    public function getAccessTokens(): array
    {
        return $this->accessTokens;
    }

    /** @return list<int> */
    public function getManagedResourceIds(): array
    {
        return $this->managedResourceIds;
    }
}