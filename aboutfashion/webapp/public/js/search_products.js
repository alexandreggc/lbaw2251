fetch("/api/products")
.then(function(response){
    return response.json();
})
.then(function(products){
    let placeholder = document.querySelector("#data-output");
    let out = "";
    for( let product of products){
        out += `
                <div class="col-md-3 col-sm-6 mx-2 mt-2 mb-2 d-inline-block">
                    <div class="product-grid">
                        <div class="product-image shadow">
                            <a href="#" class="image">
                                <img src="${product.image[0]}">
                            </a>
                            <ul class="product-links">
                                <li><a href="#"><i class="fa fa-search"></i></a></li>
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            </ul>
                            <a href="" class="add-to-cart">Add to Cart</a>
                        </div>
                        <div class="product-content shadow">
                            <h3 class="title"><a href="#">Women's Blouse Top</a></h3>
                            <div class="price">$53.55 </div>
                        </div>
                    </div>
                </div>
        `;
    }
})