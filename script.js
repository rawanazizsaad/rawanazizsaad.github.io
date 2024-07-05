let products = JSON.parse(localStorage.getItem('products')) || [
   { sku: 'JVC200123', name: 'Acme DISC', price: 1.00, attribute: 'Size: 700 MB' },
   { sku: 'GGWP0007', name: 'War and Peace', price: 20.00, attribute: 'Weight: 2KG' },
   { sku: 'TR120555', name: 'Chair', price: 40.00, attribute: 'Dimensions: 24x45x15' }
];

function displayProducts() {
   const productList = document.getElementById('product-list');
   productList.innerHTML = '';

   products.forEach(product => {
       const productItem = document.createElement('div');
       productItem.classList.add('product-item');
       productItem.innerHTML = `
           <input type="checkbox" class="delete-checkbox">
           <p>${product.sku}</p>
           <p>${product.name}</p>
           <p>${product.price.toFixed(2)} $</p>
           <p>${product.attribute}</p>
       `;
       productList.appendChild(productItem);
   });
}

function updateForm() {
    const productType = document.getElementById('productType').value;
    const attributeContainer = document.getElementById('product-specific-attribute');
    attributeContainer.innerHTML = '';

    if (productType === 'DVD') {
        attributeContainer.innerHTML = `
            <div>
                <label for="size">Size (MB):</label>
                <input type="number" id="size" name="size" required>
                <p>Please provide size in MB.</p>
            </div>`;
    } else if (productType === 'Book') {
        attributeContainer.innerHTML = `
            <div>
                <label for="weight">Weight (KG):</label>
                <input type="number" id="weight" name="weight" required>
                <p>Please provide weight in KG.</p>
            </div>`;
    } else if (productType === 'Furniture') {
        attributeContainer.innerHTML = `
            <div>
                <label for="height">Height (CM):</label>
                <input type="number" id="height" name="height" required>
            </div>
            <div>
                <label for="width">Width (CM):</label>
                <input type="number" id="width" name="width" required>
            </div>
            <div>
                <label for="length">Length (CM):</label>
                <input type="number" id="length" name="length" required>
                <p>Please provide dimensions in CM (HxWxL).</p>
            </div>`;
    }
}

function cancel() {
    window.location.href = 'product_list.html';
}

function saveProduct() {
    const form = document.getElementById('product_form');
    const message = document.getElementById('message');

    // Validate form data
    const sku = document.getElementById('sku').value;
    const name = document.getElementById('name').value;
    const price = parseFloat(document.getElementById('price').value);
    const productType = document.getElementById('productType').value;

    if (!sku || !name || isNaN(price) || !productType) {
        message.innerText = 'Please fill in all required fields.';
        return;
    }

    // Submit the form using AJAX
    const xhr = new XMLHttpRequest();
    xhr.open('POST', form.action, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                message.innerText = xhr.responseText;
                if (xhr.responseText.includes('successfully')) {
                    // Optional: Redirect after successful save
                    setTimeout(() => {
                        window.location.href = 'product_list.html';
                    }, 1000); // 1 second delay before redirection
                }
            } else {
                message.innerText = 'Error saving product: ' + xhr.status;
            }
        }
    };
    xhr.send(new URLSearchParams(new FormData(form)));
}

function cancel() {
    window.location.href = 'product_list.html'; // Replace with actual URL
}

function massDelete() {
    const checkboxes = document.querySelectorAll('.delete-checkbox:checked');
    checkboxes.forEach(checkbox => {
        const productItem = checkbox.closest('.product-item');
        productItem.remove();
    });
}

document.getElementById('delete-product-btn').addEventListener('click', massDelete);

window.onload = function() {
   if (document.getElementById('product-list')) {
       displayProducts();
   }

   const productForm = document.getElementById('product_form');
   if (productForm) {
       productForm.addEventListener('submit', saveProduct);
   }
}
