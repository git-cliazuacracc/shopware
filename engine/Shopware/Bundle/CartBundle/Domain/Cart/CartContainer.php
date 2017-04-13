<?php
declare(strict_types=1);
/**
 * Shopware 5
 * Copyright (c) shopware AG
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "Shopware" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, title and interest in
 * our trademarks remain entirely with us.
 */

namespace Shopware\Bundle\CartBundle\Domain\Cart;

use Ramsey\Uuid\Uuid;
use Shopware\Bundle\CartBundle\Domain\LineItem\LineItemCollection;
use Shopware\Bundle\StoreFrontBundle\Common\Struct;

class CartContainer extends Struct
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var LineItemCollection
     */
    protected $lineItems;

    /**
     * @var string
     */
    protected $token;

    public function __construct(string $name, string $token, LineItemCollection $lineItems)
    {
        $this->name = $name;
        $this->token = $token;
        $this->lineItems = $lineItems;
    }

    public static function createNew(string $name): CartContainer
    {
        return new self($name, Uuid::uuid4()->toString(), new LineItemCollection());
    }

    public static function createExisting(string $name, string $token, array $items): CartContainer
    {
        return new self($name, $token, new LineItemCollection($items));
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getLineItems(): LineItemCollection
    {
        return $this->lineItems;
    }
}