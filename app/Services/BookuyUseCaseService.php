<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Category;
use App\Models\Review;
use App\Models\Seller;
use Illuminate\Support\Collection;

/**
 * BookuyUseCaseService
 * 
 * Service layer implementing CDR use cases with exact naming from the Critical Design Review.
 * Contains public use case methods and private sequence methods matching CDR identifiers.
 */
class BookuyUseCaseService
{
    // =========================================================================
    // USE CASE 1: ViewRecommended
    // =========================================================================

    /**
     * ViewRecommended - Main use case entry point
     * Returns data for the HalamanUtama (homepage) showing recommended books.
     */
    public function ViewRecommended(): array
    {
        $this->LoadHalamanUtama();

        $recommendedBooks = $this->ShowRecommended();
        $popularBooks = $this->ReturnDaftarBuku();
        $categories = Category::orderBy('name')->get();

        $bookIds = $this->GetBookId($recommendedBooks);

        return [
            'recommendedBooks' => $recommendedBooks,
            'popularBooks' => $popularBooks,
            'categories' => $categories,
            'bookIds' => $bookIds,
        ];
    }

    /**
     * LoadHalamanUtama - CDR sequence identifier
     * Initializes the homepage loading process.
     */
    private function LoadHalamanUtama(): void
    {
        // Initialization hook - can be used for logging, analytics, etc.
    }

    /**
     * ShowRecommended - CDR sequence identifier
     * Fetches recommended books for display.
     */
    private function ShowRecommended(): Collection
    {
        return Book::with('categories')
            ->where('is_recommended', true)
            ->orWhere(function ($query) {
                $query->inRandomOrder();
            })
            ->take(10)
            ->get();
    }

    /**
     * GetBookId - CDR sequence identifier
     * Extracts book IDs from a collection of books.
     */
    private function GetBookId(Collection $books): array
    {
        return $books->pluck('id')->toArray();
    }

    /**
     * ReturnDaftarBuku - CDR sequence identifier
     * Returns the list of popular books.
     */
    private function ReturnDaftarBuku(): Collection
    {
        return Book::orderByDesc('popularity_score')
            ->take(10)
            ->get();
    }

    // =========================================================================
    // USE CASE 2: ViewBookDetails (includes integrated review loading)
    // =========================================================================

    /**
     * ViewBookDetails - Main use case entry point
     * Returns book details including reviews (integrated as per CDR requirement).
     */
    public function ViewBookDetails(int $bookId): array
    {
        $this->LoadHalamanProduk($bookId);

        $bookIdVerified = $this->CallBookId($bookId);
        $book = $this->ReturnBookId($bookIdVerified);

        $sellerId = $this->CallUserId($book);
        $seller = $this->ReturnUserId($sellerId);

        $bookDetails = $this->ShowDeskripsiBuku($book);

        // Integrated review loading (CDR: reviews must be on same page)
        $this->LoadReviewBook($bookId);
        $reviews = $this->CallReview($bookId);
        $reviewIds = $this->GetReviewId($reviews);
        $reviewsFromBook = $this->ReturnReviewidBuku($bookId);
        $reviewData = $this->ShowDaftarReviewBuku($reviewsFromBook);

        return [
            'book' => $book,
            'seller' => $seller,
            'reviews' => $reviewsFromBook,
            'reviewData' => $reviewData,
            'bookDetails' => $bookDetails,
        ];
    }

    /**
     * LoadHalamanProduk - CDR sequence identifier
     * Initializes the product page loading process.
     */
    private function LoadHalamanProduk(int $bookId): void
    {
        // Initialization hook for product page
    }

    /**
     * CallBookId - CDR sequence identifier
     * Validates and returns the book ID.
     */
    private function CallBookId(int $bookId): int
    {
        return $bookId;
    }

    /**
     * ReturnBookId - CDR sequence identifier
     * Fetches and returns the book by ID.
     */
    private function ReturnBookId(int $bookId): Book
    {
        return Book::with(['categories', 'seller', 'reviews'])->findOrFail($bookId);
    }

    /**
     * CallUserId - CDR sequence identifier
     * Extracts the seller ID from the book.
     */
    private function CallUserId(Book $book): ?int
    {
        return $book->seller_id;
    }

    /**
     * ReturnUserId - CDR sequence identifier
     * Fetches and returns the seller by ID.
     */
    private function ReturnUserId(?int $sellerId): ?Seller
    {
        if (!$sellerId) {
            return null;
        }
        return Seller::find($sellerId);
    }

    /**
     * ShowDeskripsiBuku - CDR sequence identifier
     * Prepares book description data for display.
     */
    private function ShowDeskripsiBuku(Book $book): array
    {
        return [
            'title' => $book->title,
            'author' => $book->author,
            'description' => $book->full_description ?? $book->short_description,
            'price_buy' => $book->price_buy,
            'price_rent' => $book->price_rent,
            'condition' => $book->condition,
            'address' => $book->address,
            'pages' => $book->pages,
            'category' => $book->categories->first()->name ?? $book->category,
            'rating_average' => $book->rating_average ?? 0,
            'rating_count' => $book->rating_count ?? 0,
        ];
    }

    // =========================================================================
    // REVIEW INTEGRATION (part of ViewBookDetails, not separate page)
    // =========================================================================

    /**
     * LoadReviewBook - CDR sequence identifier
     * Initializes the review loading process.
     */
    private function LoadReviewBook(int $bookId): void
    {
        // Initialization hook for review loading
    }

    /**
     * CallReview - CDR sequence identifier
     * Fetches reviews for a book.
     */
    private function CallReview(int $bookId): Collection
    {
        return Review::where('book_id', $bookId)->get();
    }

    /**
     * GetReviewId - CDR sequence identifier
     * Extracts review IDs from a collection.
     */
    private function GetReviewId(Collection $reviews): array
    {
        return $reviews->pluck('id')->toArray();
    }

    /**
     * ReturnReviewidBuku - CDR sequence identifier
     * Returns reviews for a specific book.
     */
    private function ReturnReviewidBuku(int $bookId): Collection
    {
        return Review::where('book_id', $bookId)
            ->orderByDesc('created_at')
            ->get();
    }

    /**
     * ShowDaftarReviewBuku - CDR sequence identifier
     * Prepares review data for display.
     */
    private function ShowDaftarReviewBuku(Collection $reviews): array
    {
        return $reviews->map(function ($review) {
            return [
                'id' => $review->id,
                'reviewer_name' => $review->reviewer_name ?? 'Anonim',
                'rating' => $review->stars ?? 0,
                'comment' => $review->comment,
                'created_at' => $review->created_at,
            ];
        })->toArray();
    }

    // =========================================================================
    // USE CASE 3: ViewSellerProfile
    // =========================================================================

    /**
     * ViewSellerProfile - Main use case entry point
     * Returns seller profile data including their listed books.
     */
    public function ViewSellerProfile(int $sellerId): array
    {
        $seller = Seller::findOrFail($sellerId);

        $sellerBooks = Book::where('seller_id', $sellerId)
            ->orderByDesc('popularity_score')
            ->get();

        return [
            'seller' => $seller,
            'sellerBooks' => $sellerBooks,
        ];
    }

    // =========================================================================
    // USE CASE 4: AddToCart (Database-based)
    // =========================================================================

    /**
     * AddToCart - Main use case entry point
     * Adds a book to the cart in the database, incrementing quantity if already present.
     * 
     * @param int|null $userId User ID (nullable for session-based cart)
     * @param int $itemId Book ID to add
     * @param string $type Cart type: 'buy' or 'rent'
     * @return array Result with status
     */
    public function AddToCart(?int $userId, int $itemId, string $type, array $bookData = []): array
    {
        $harga = $this->getBookPrice($itemId, $type);
        $priceData = $this->dataHarga($harga);

        // Use database-based cart
        $cart = \App\Models\Cart::getOrCreateCart();

        $result = $this->saveToCart($cart, $itemId, $type, $harga, $bookData);

        return $this->statusSukses();
    }

    /**
     * getBookPrice - CDR sequence identifier
     * Fetches the book price based on type (buy/rent).
     */
    private function getBookPrice(int $itemId, string $type): int
    {
        $book = Book::find($itemId);

        if (!$book) {
            return 0;
        }

        if ($type === 'rent') {
            return (int) ($book->price_rent ?? $book->price ?? 0);
        }

        return (int) ($book->price_buy ?? $book->price ?? 0);
    }

    /**
     * dataHarga - CDR sequence identifier
     * Prepares price data structure.
     */
    private function dataHarga(int $price): array
    {
        return [
            'harga' => $price,
            'formatted' => 'Rp ' . number_format($price, 0, ',', '.'),
        ];
    }

    /**
     * saveToCart - CDR sequence identifier
     * Saves item to database cart, incrementing quantity if duplicate.
     */
    private function saveToCart(\App\Models\Cart $cart, int $itemId, string $type, int $harga, array $bookData): \App\Models\CartItem
    {
        $mode = $type === 'rent' ? 'rent' : 'buy';

        // Check if item already exists in cart
        $existingItem = $cart->items()
            ->where('book_id', $itemId)
            ->where('type', $mode)
            ->first();

        if ($existingItem) {
            // Increment quantity instead of duplicating
            $existingItem->quantity += 1;
            $existingItem->save();
            return $existingItem;
        }

        // Add new item
        return $cart->items()->create([
            'book_id' => $itemId,
            'type' => $mode,
            'price' => $harga,
            'quantity' => 1,
        ]);
    }

    /**
     * statusSukses - CDR sequence identifier
     * Returns success status after cart operation.
     */
    private function statusSukses(): array
    {
        return [
            'success' => true,
            'message' => 'Item ditambahkan ke keranjang',
        ];
    }
}
