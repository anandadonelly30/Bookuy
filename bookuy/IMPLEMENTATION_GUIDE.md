# BOOKUY - IMPLEMENTASI LENGKAP SESUAI FIGMA DESIGN

## 📋 Overview
Proyek ini adalah implementasi lengkap dari design Figma Bookuy dengan 5 use case utama:
1. **ViewCart** - Keranjang Belanja
2. **CheckOut** - Proses Checkout
3. **ManageAddress** - Kelola Alamat
4. **ViewNotif** - Lihat Notifikasi  
5. **EditProfile** - Edit Profil

## 🎨 Design System

### Colors (dari tailwind.config.js)
- **Primary**: `#3B82F6` - Biru utama untuk buttons dan accents
- **Primary Dark**: `#2563EB` - Hover state
- **Background**: `#F8FAFC` - Light gray background
- **Card**: `#FFFFFF` - White cards
- **Text Primary**: `#0F172A` - Dark text
- **Text Secondary**: `#64748B` - Gray text
- **Success**: `#10B981` - Green
- **Danger**: `#EF4444` - Red
- **Orange**: `#FF9500` - Orange accent

### Typography
- **Font**: Inter, system-ui
- **Sizes**: Menggunakan Tailwind default (text-xs, text-sm, text-base, text-lg, text-xl, text-2xl)

## 📁 Struktur File Yang Sudah Di-Update

### 1. Database Migrations
✅ **Updated**
- `2025_11_18_100001_create_products_table.php` - Ditambah: category, mata_kuliah, location, author, stock, type
- `2025_11_18_100002_create_addresses_table.php` - Ditambah: department, latitude, longitude
- `2025_11_18_100003_create_cart_items_table.php` - Ditambah: type (sell/rent)

### 2. Models
✅ **Updated**
- `Product.php` - Ditambah relations dan fillable fields
- `Address.php` - Ditambah department, coordinates, relations
- `CartItem.php` - Ditambah type dan subtotal accessor

### 3. Controllers
✅ **Updated**
- `DashboardController.php` - Filter, search, sort functionality
- `CartController.php` - AJAX support, stock validation

### 4. Configuration
✅ **Updated**
- `tailwind.config.js` - Custom colors sesuai Figma design

### 5. Seeders
✅ **Created**
- `ProductSeeder.php` - Data dummy products dengan berbagai mata kuliah

## 🚀 Cara Setup

### 1. Install Dependencies
```bash
composer install
npm install
```

### 2. Setup Environment
```bash
copy .env.example .env
php artisan key:generate
```

### 3. Database Setup
```bash
# Pastikan database.sqlite ada atau buat database MySQL
php artisan migrate:fresh
php artisan db:seed --class=ProductSeeder
```

### 4. Build Assets
```bash
npm run build
# atau untuk development
npm run dev
```

### 5. Run Server
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## 📝 File Views Yang Perlu Dibuat/Diupdate

### 1. Homepage/Dashboard (`resources/views/dashboard.blade.php`)
**Fitur:**
- Search bar dengan filter button
- Kategori pills (Matematika, MPB, PWEB, SE, SKPB, dll)
- Recommended books grid (6 items)
- Popular books grid (6 items)
- Filter modal dengan:
  - Sort by (Recommended, Price Low-High, Price High-Low)
  - Price range slider
  - Mata Kuliah checkboxes
  - Location checkboxes
- Bottom navigation bar
- Add to cart functionality

**Screenshot Reference:** Frame 90

### 2. Cart View (`resources/views/cart/index.blade.php`)
**Fitur:**
- Header "Keranjang"
- Tabs: Beli / Sewa
- List cart items dengan:
  - Product image
  - Product name dan detail
  - Quantity controls (- / + buttons)
  - Delete button
  - Price per item
- Empty state: "Your Cart is Empty!" dengan ilustrasi
- Order summary:
  - Sub-total
  - Biaya Admin (%)
  - Shipping fee
  - Total
- "Go To Checkout" button (orange/blue gradient)

**Screenshot Reference:** Keranjang Beli, Keranjang Sewa

### 3. Checkout View (`resources/views/checkout/index.blade.php`)
**Fitur:**
- Delivery Address section dengan "Change" button
- Payment Method selection:
  - E-wallet (dengan card number dan edit icon)
  - Cash
  - Apple Pay
- Order Summary:
  - Sub-total
  - Biaya Admin (%)
  - Shipping fee
  - Total
- Promo code input dengan "Add" button
- "Place Order" button (blue)

**Screenshot Reference:** Frame 37, Checkout

### 4. Checkout Success & Track Order (`resources/views/checkout/success.blade.php`)
**Fitur:**
- Congratulations message
- Illustration
- Order Status Timeline:
  - Packing (with timestamp)
  - Picked (with timestamp)
  - In Transit (current)
  - Delivered
- "Track Your Order" button
- Map with delivery route
- Courier info dengan call button

**Screenshot Reference:** Track Order frame

### 5. Address Management (`resources/views/address/index.blade.php` & `create.blade.php`)
**Fitur:**
**Index:**
- List of saved addresses:
  - Home (with icon and address)
  - Office
  - Apartment  
  - Parent's House
  - Department (with department name)
- Radio buttons untuk select
- "Add New Address" button
- "Apply" button

**Create/Edit:**
- Map view dengan pin
- Address Nickname dropdown (Home, Office, Apartment, etc)
- Department dropdown (for Department type)
- Full Address text area
- "Save" button
- Success modal "Congratulations! Your new address has been added"

**Screenshot Reference:** Address frames, New Address frames

### 6. Notifications (`resources/views/notifications/index.blade.php`)
**Fitur:**
- Header "Notifications"
- Grouped by date (Today, Yesterday, May 7 2025, etc)
- Each notification has:
  - Icon (discount, wallet, service, etc)
  - Title (bold)
  - Message
  - Unread indicator (blue dot)
- Bottom navigation

**Screenshot Reference:** Notification frame

### 7. Profile Edit (`resources/views/profile/edit.blade.php`)
**Fitur yang perlu ditambah:**
- Profile photo upload
- Name field
- Email field
- Phone number field
- Address field (optional, bisa link ke address management)
- Save button

## 🎯 Routes Yang Sudah Tersedia

```php
// Dashboard/Homepage
GET / -> dashboard (with filters, search)

// Cart
GET /cart -> cart.index
POST /cart/add/{product} -> cart.add
PATCH /cart/update/{cartItem} -> cart.update
DELETE /cart/remove/{cartItem} -> cart.remove

// Checkout
GET /checkout -> checkout.index
POST /checkout/process -> checkout.process
GET /checkout/success/{order} -> checkout.success

// Address
GET /addresses -> address.index
GET /addresses/create -> address.create
POST /addresses -> address.store
GET /addresses/{address}/edit -> address.edit
PATCH /addresses/{address} -> address.update
DELETE /addresses/{address} -> address.destroy
PATCH /addresses/{address}/set-default -> address.setDefault

// Notifications
GET /notifications -> notifications.index
POST /notifications/{notification}/read -> notifications.read

// Profile
GET /profile -> profile.edit
PATCH /profile -> profile.update
DELETE /profile -> profile.destroy
```

## 💡 Tips Implementasi

### 1. Gunakan Components
Buat reusable components untuk:
- Product card
- Bottom navigation
- Modal/Dialog
- Empty state

### 2. Gunakan Alpine.js
Untuk interactivity ringan:
- Filter modal toggle
- Quantity controls
- Tab switching

### 3. Icons
Gunakan Heroicons (sudah include di Tailwind):
```html
<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="..."></path>
</svg>
```

### 4. Responsive Design
Gunakan Tailwind breakpoints:
- `sm:` - 640px
- `md:` - 768px
- `lg:` - 1024px
- `xl:` - 1280px

### 5. Loading States
Tambahkan loading indicators untuk:
- Add to cart
- Checkout process
- Form submissions

## 🐛 Debugging

### Jika error "Undefined method 'all'"
Ini false positive dari IDE. Install Laravel IDE Helper:
```bash
composer require --dev barryvdh/laravel-ide-helper
php artisan ide-helper:generate
```

### Jika error "Class not found"
```bash
composer dump-autoload
php artisan config:clear
php artisan cache:clear
```

### Jika Tailwind classes tidak berfungsi
```bash
npm run build
# atau
npm run dev
```

## 📦 Next Steps

1. **Buat file views** sesuai dengan struktur di atas
2. **Update User model** untuk relasi cartItems, addresses, notifications
3. **Buat seeder** untuk dummy users, addresses, notifications
4. **Testing** setiap use case
5. **Optimization** - add caching, lazy loading untuk images

## 📸 Screenshot References

Lihat file attachment Figma untuk:
- **Homepage**: Frame 90 dengan kategori dan filter (Frame 90-96)
- **Search & Filter**: Frame 92-96 (Filter modal dengan Sort By, Price, Location)
- **Cart**: Keranjang Beli & Sewa frames
- **Checkout**: Frame 37 dan Checkout frames
- **Track Order**: Track Order frame dengan map dan timeline
- **Address**: Address frames dan New Address frames
- **Notifications**: Notification frame dengan grouping
- **Chat**: Chat frames (opsional, belum diimplementasi)
- **Payment**: Payment frames untuk manage cards

## ✅ Checklist Implementation

- [x] Database migrations updated
- [x] Models updated with relations
- [x] Tailwind config with custom colors
- [x] Dashboard controller with filters
- [x] Cart controller with AJAX support
- [x] Product seeder created
- [ ] Dashboard view dengan UI baru
- [ ] Cart view (empty state & with items)
- [ ] Checkout view
- [ ] Checkout success & track order view
- [ ] Address list & create view
- [ ] Notifications view
- [ ] Profile edit view updated
- [ ] Bottom navigation component
- [ ] Filter modal component
- [ ] Product card component
- [ ] Testing all use cases

---

**Dibuat oleh:** GitHub Copilot
**Tanggal:** November 18, 2025
**Versi:** 1.0
