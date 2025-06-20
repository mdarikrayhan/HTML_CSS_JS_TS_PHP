<?php require('views/partials/head.php') ?>
<?php require('views/partials/nav.php') ?>
<?php require('views/partials/banner.php') ?>


<div class="bg-white">
    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
        <h2 class="text-2xl font-bold tracking-tight text-gray-900">Available Products</h2>

        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">

            <!-- <div class="group relative">
                <img src="https://tailwindcss.com/plus-assets/img/ecommerce-images/product-page-01-related-product-01.jpg"
                    alt="Plain black cotton crew neck t-shirt lying flat against white background, showing clean minimalist design and casual everyday style"
                    class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80" />
                <div class="mt-4 flex justify-center">
                    <a href="#" class="text-sm font-semibold text-gray-900">T-Shirts</a>
                    <span class="sr-only">,</span>
                    <p class="ml-2 text-sm text-gray-500">10 items</p>
                </div>
            </div> -->
            <!-- More products... -->
        </div>
    </div>
</div>


  
<script>
    <?php
    global $db;
    //check if there is a id in the URL
    if (isset($_GET['category_id'])) {
        $id = $_GET['category_id'];
        $query = "SELECT * FROM products WHERE category_id = :category_id";
        $params = [':category_id' => $id];
        $result = $db->query($query, $params)->fetchAll(PDO::FETCH_ASSOC);
        // If no products are found, you might want to handle that case
        if (empty($result)) {
            echo "console.log('No products found for category ID: $id');";
        } else {
            echo "console.log('Products found for category ID: $id');";
        }
    } else {
        $id = null;
        // If no id is provided, fetch all products
        $query = "SELECT * FROM products";
        $result = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
    
    ?>
    //print the id in the console
    console.log("Product ID: <?php echo $id; ?>");
    const products = <?php echo json_encode($result); ?>;
    console.log(products);
    const productContainer = document.querySelector('.grid');
    products.forEach(product => {
        const productDiv = document.createElement('div');
        productDiv.className = 'group relative';
        productDiv.innerHTML = `
            <img src="../${product.image_url}" alt="${product.name}"
                class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80" />
            <div class="mt-4 flex justify-center">
                <a href="/product?action=view&id=${product.id}" class="text-sm font-semibold text-gray-900">${product.name}</a>
                <span class="sr-only">,</span>
                <p class="ml-2 text-sm text-gray-500">${product.description}</p>
            </div>
        `;
        productContainer.appendChild(productDiv);
    });


</script>

<?php require('views/partials/footer.php') ?>