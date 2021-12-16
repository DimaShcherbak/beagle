<?php
declare(strict_types=1);

namespace SDN\SendOrder\Observer\Sales;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class OrderPlaceAfter implements ObserverInterface
{
    const TELEGRAM_CHAT_ID = '-764969191';
    const TELEGRAM_TOKEN = 'bot5036551008:AAGuZp0dALHhV_WiMayiTrMrzT963c8W7TU/';
    /**
     * Execute observer
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getData('order');
        $order_id = $order->getData('increment_id');
//        $quot_id = $order->getData('quote_id');
//        $customerEmail = $order->getData('addresses')[0]->getData('email');
        $productName = $order->getAllVisibleItems()[0]->getData('name');
        $productSku = $order->getAllVisibleItems()[0]->getData('sku');
        $wherehouse = $order->getData('addresses')[0]->getData('street'); // В поле стрит вбиваем номер отделения или адресс
        $city = $order->getData('addresses')[0]->getData('city'); // В поле стрит вбиваем номер отделения или адресс
        $shipping = $order->getData('shipping_description');
        $customerName = $order->getData('customer_firstname');
        $customerLastName = $order->getData('customer_lastname');
        $customerPhone = $order->getData('addresses')[0]->getData('telephone');

        $chat_id = '-764969191';        // чат id берем из telegram bota

        $text = 'Имя:' . ' ' . $customerName . "\n" . 'Фамилия:' . ' ' . $customerLastName . "\n" . 'Телефон:' . ' ' . $customerPhone . "\n" . 'Тип доставки:' . ' ' . $shipping . "\n" . 'Город:' . ' ' . $city . "\n" . 'Номер отделения:' . ' №' . $wherehouse
            . "\n" . 'Order_id:' . ' ' . $order_id . "\n" . 'SKU:' . ' ' . $productSku . "\n" . 'Имя Продукта:' . ' ' . $productName;
        $message = urlencode("$text");
        fopen("https://api.telegram.org/bot5036551008:AAGuZp0dALHhV_WiMayiTrMrzT963c8W7TU/sendMessage?chat_id=$chat_id&text=" .$message, "r");
//        fopen("https://api.telegram.org/bot5036551008:AAGuZp0dALHhV_WiMayiTrMrzT963c8W7TU/sendMessage?chat_id=$chat_id&text=" .$message, "r");
    }
}
