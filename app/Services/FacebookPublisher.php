<?php

namespace App\Services;

use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Illuminate\Support\Facades\Log;
use App\Models\Produit;

class FacebookPublisher
{
    protected $facebook;
    protected $pageId;
    protected $pageAccessToken;

    public function __construct()
    {
        $this->facebook = new Facebook([
            'app_id' => config('services.facebook.app_id'),
            'app_secret' => config('services.facebook.app_secret'),
            'default_graph_version' => 'v19.0',
        ]);

        $this->pageId = config('services.facebook.page_id');
        $this->pageAccessToken = config('services.facebook.page_access_token');
    }

    /**
     * Publish product to Facebook page
     */
    public function publishProduct(Produit $produit): bool
    {
        try {
            if (!$this->pageAccessToken) {
                Log::error('Facebook page access token not configured');
                throw new \Exception('Token d\'accès Facebook non configuré');
            }

            // Build post message
            $message = $this->buildProductMessage($produit);
            $link = route('products');
            $imageUrl = $this->getProductImageUrl($produit);

            // Prepare post parameters
            $params = [
                'message' => $message,
            ];

            if ($imageUrl) {
                $params['link'] = $link;
                $params['picture'] = $imageUrl;
            }

            // Send request to Facebook
            $response = $this->facebook->post(
                "/{$this->pageId}/feed",
                $params,
                $this->pageAccessToken
            );

            $postId = $response->getGraphNode()->getField('id');
            
            Log::info("Product published to Facebook: {$postId}");
            
            return true;
        } catch (FacebookResponseException $e) {
            Log::error("Facebook Response Error: " . $e->getMessage());
            throw new \Exception("Erreur Facebook: " . $e->getMessage());
        } catch (FacebookSDKException $e) {
            Log::error("Facebook SDK Error: " . $e->getMessage());
            throw new \Exception("Erreur SDK Facebook: " . $e->getMessage());
        }
    }

    /**
     * Build formatted message for product
     */
    protected function buildProductMessage(Produit $produit): string
    {
        $message = "🌾 Nouveau produit: {$produit->nom}\n\n";
        $message .= "{$produit->description_courte}\n\n";
        $message .= "💰 Prix: {$produit->prix}\n";
        $message .= "📦 Catégorie: {$produit->categorie}\n\n";
        $message .= "👉 Découvrez nos produits bio sur notre site !";
        
        return $message;
    }

    /**
     * Get product image URL
     */
    protected function getProductImageUrl(Produit $produit): ?string
    {
        if (!$produit->image) {
            return null;
        }

        return asset('storage/' . $produit->image);
    }

    /**
     * Test Facebook connection
     */
    public function testConnection(): bool
    {
        try {
            if (!$this->pageAccessToken) {
                throw new \Exception('Token d\'accès Facebook non configuré');
            }

            $response = $this->facebook->get(
                "/{$this->pageId}",
                $this->pageAccessToken
            );

            return $response->getGraphNode()->getField('id') === $this->pageId;
        } catch (\Exception $e) {
            Log::error("Facebook connection test failed: " . $e->getMessage());
            return false;
        }
    }
}
