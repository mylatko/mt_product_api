<?php


namespace App\Tests\Api;

use App\DataFixtures\ProductFixtures;
use App\Service\Product\Category;
use App\Tests\ApiTester;
use Codeception\Example;
use Codeception\Util\HttpCode;

class ProductListTestCest
{
    public function _before(ApiTester $I)
    {
    }

    /**
     * @param ApiTester $I
     * @param Example $example
     * @dataProvider ProductListProvider
     */
    public function ProductListTest(ApiTester $I, Example $example)
    {
        $endPoint = "/product";

        $I->wantToTest($example['name']);

        $I->sendGet($endPoint, $example['body']);
        $I->seeResponseCodeIs($example['httpCode']);
        $I->seeResponseIsJson();

        if (isset($example['body']['category']) && ($example['httpCode'] == HttpCode::OK)) {
            $response = $I->grabDataFromResponseByJsonPath('$data.0');
            foreach ($response as $item) {
                $I->assertEquals($item['category'], ucfirst($example['body']['category']));
            }
        }

        if (isset($example['expectedResult']) && ($example['httpCode'] == HttpCode::OK)) {
            $response = $I->grabDataFromResponseByJsonPath('$data.0');
            $I->assertEquals($response, $example['expectedResult']);
        }
    }

    private function productListProvider()
    {
        return [
            [
                'name' => 'success with empty request',
                'body' => [],
                'httpCode' => HttpCode::OK
            ],
            [
                'name' => 'not valid category',
                'body' => [
                    "category" => "tmp"
                ],
                'httpCode' => HttpCode::BAD_REQUEST
            ],
            [
                'name' => 'success with valid category',
                'body' => [
                    "category" => Category::BOOTS
                ],
                'httpCode' => HttpCode::OK
            ],
            [
                'name' => 'success with valid category, priceLessThan',
                'body' => [
                    "category" => Category::BOOTS,
                    "priceLessThan" => 1000
                ],
                'httpCode' => HttpCode::OK
            ],
            [
                'name' => 'priceLessThan less than min',
                'body' => [
                    "category" => "boots",
                    "priceLessThan" => ProductFixtures::MIN_COST
                ],
                'expectedResult' => [],
                'httpCode' => HttpCode::OK
            ],
        ];
    }
}
