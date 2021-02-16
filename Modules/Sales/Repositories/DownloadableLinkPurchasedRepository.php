<?php

namespace Modules\Sales\Repositories;

use Illuminate\Container\Container as App;
use Modules\Core\Eloquent\Repository;
use Modules\Sales\Contracts\DownloadableLinkPurchased;
use Modules\Product\Repositories\ProductDownloadableLinkRepository;

class DownloadableLinkPurchasedRepository extends Repository
{

    /**
     * ProductDownloadableLinkRepository object
     *
     * @var \Modules\Product\Repositories\ProductDownloadableLinkRepository
     */
    protected $productDownloadableLinkRepository;

    /**
     * Create a new repository instance.
     *
     * @param  \Modules\Product\Repositories\ProductDownloadableLinkRepository  $productDownloadableLinkRepository
     * @return void
     */
    public function __construct(
        ProductDownloadableLinkRepository $productDownloadableLinkRepository,
        App $app
    )
    {
        $this->productDownloadableLinkRepository = $productDownloadableLinkRepository;

        parent::__construct($app);
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return DownloadableLinkPurchased::class;
    }

    /**
     * @param  \Modules\Sales\Contracts\OrderItem  $orderItem
     * @return void
     */
    public function saveLinks($orderItem)
    {
        if (! $this->isValidDownloadableProduct($orderItem)) {
            return;
        }

        foreach ($orderItem->additional['links'] as $linkId) {
            if (! $productDownloadableLink = $this->productDownloadableLinkRepository->find($linkId)) {
                continue;
            }

            $this->create([
                'name'            => $productDownloadableLink->title,
                'product_name'    => $orderItem->name,
                'url'             => $productDownloadableLink->url,
                'file'            => $productDownloadableLink->file,
                'file_name'       => $productDownloadableLink->file_name,
                'type'            => $productDownloadableLink->type,
                'download_bought' => $productDownloadableLink->downloads * $orderItem->qty_ordered,
                'status'          => 'pending',
                'customer_id'     => $orderItem->order->customer_id,
                'order_id'        => $orderItem->order_id,
                'order_item_id'   => $orderItem->id,
            ]);
        }
    }

    /**
     * Return true, if ordered item is valid downloadable product with links
     *
     * @param  \Modules\Sales\Contracts\OrderItem  $orderItem
     * @return bool
     */
    private function isValidDownloadableProduct($orderItem) : bool {
        if (stristr($orderItem->type,'downloadable') !== false && isset($orderItem->additional['links'])) {
            return true;
        }

        return false;
    }

    /**
     * @param  \Modules\Sales\Contracts\OrderItem  $orderItem
     * @param  string    $status
     * @return void
     */
    public function updateStatus($orderItem, $status)
    {
        $purchasedLinks = $this->findByField('order_item_id', $orderItem->id);

        foreach ($purchasedLinks as $purchasedLink) {
            if ($status == 'expired') {
                if (count($purchasedLink->order_item->invoice_items) > 0) {
                    $totalInvoiceQty = 0;

                    foreach ($purchasedLink->order_item->invoice_items as $invoice_item) {
                        $totalInvoiceQty = $totalInvoiceQty + $invoice_item->qty;
                    }

                    $this->update([
                        'status' => $purchasedLink->download_used == $totalInvoiceQty ? $status : $purchasedLink->status,
                        'download_canceled' => $purchasedLink->download_bought - $totalInvoiceQty,
                    ], $purchasedLink->id);
                } else {
                    $this->update([
                        'status' => $status,
                        'download_canceled' => $purchasedLink->download_bought,
                    ], $purchasedLink->id);
                }
            } else {
                $this->update([
                    'status' => $status,
                ], $purchasedLink->id);
            }
        }
    }
}