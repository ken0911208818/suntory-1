<template>
    <div>
        <div class='products'>
            <div v-for='(product, index) in productsData' :key="index" class='product {{ product.product | lowercase }}'><!-- track-by='$index' -->
                <div class='image' @click='viewProduct(product)' v-bind:style='{ backgroundImage: "url(" + product.image + ")" }' style='background-size: cover; background-position: center;'></div>
                <div class='name'>{{ product.product }}</div>
                <div class='description'>{{ product.description }}</div>
                <div class='price'>{{ product.price | currency }}</div>
                <button @click='addToCart(product)'>Add to Cart</button><br><br>
            </div>
        </div>
        <div class='modalWrapper' v-show='showModal'>
            <div class='prevProduct' @click='changeProductInModal("prev")'><i class='fa fa-angle-left'></i></div>
            <div class='nextProduct' @click='changeProductInModal("next")'><i class='fa fa-angle-right'></i></div>
            <div class='overlay' @click='hideModal()'></div>
            <div class='modal'>
                <i class='close fa fa-times' @click='hideModal()'></i>
                <div class='imageWrapper'>
                    <div class='image' v-bind:style='{ backgroundImage: "url(" + modalData.image + ")" }' style='background-size: cover; background-position: center;' v-on:mouseover='imageMouseOver($event)' v-on:mousemove='imageMouseMove($event)' v-on:mouseout='imageMouseOut($event)'></div>
                </div>
                <div class='additionalImages' v-if='modalData.images'>
                    <div v-for='(image, i) in modalData.images' :key="i" class='additionalImage' v-bind:style='{ backgroundImage: "url(" + image.image + ")" }' style='background-size: cover; background-position: center;' @click='changeImage(image.image)'></div>
                </div>
                <div class='name'>{{ modalData.product }}</div>
                <div class='description'>{{ modalData.description }}</div>
                <div class='details'>{{ modalData.details }}</div>
                <h3 class='price'>{{ modalData.price | currency }}</h3>
                <label for='modalAmount'>QTY</label>
                <input id='modalAmount' value='{{ modalAmount }}' v-model='modalAmount' class='amount' @keyup.enter='modalAddToCart(modalData), hideModal()' />
                <button @click='modalAddToCart(modalData), hideModal()'>Add to Cart</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    ready: function () {
        var self = this;
        document.addEventListener("keydown", function (e) {
            if (self.showModal && e.keyCode == 37) {
                self.changeProductInModal("prev");
            } else if (self.showModal && e.keyCode == 39) {
                self.changeProductInModal("next");
            } else if (self.showModal && e.keyCode == 27) {
                self.hideModal();
            }
        });
    },
    props: ['productsData', 'cart', 'tax', 'cartSubTotal', 'cartTotal'],

    data: function () {
        return {
            showModal: false,
            modalData: {},
            modalAmount: 1,
            timeout: "",
            mousestop: ""
        }
    },

    methods: {
        addToCart: function (product) {
            var found = false;

            for (var i = 0; i < vue.cart.length; i++) {

                if (vue.cart[i].sku === product.sku) {
                    var newProduct = vue.cart[i];
                    newProduct.quantity = newProduct.quantity + 1;
                    vue.cart.$set(i, newProduct);
                    //console.log("DUPLICATE",  vue.cart[i].product + "'s quantity is now: " + vue.cart[i].quantity);
                    found = true;
                    break;
                }
            }

            if (!found) {
                product.quantity = 1;
                vue.cart.push(product);
            }

            vue.cartSubTotal = vue.cartSubTotal + product.price;
            vue.cartTotal = vue.cartSubTotal + (vue.tax * vue.cartSubTotal);
            vue.checkoutBool = true;
        },

        modalAddToCart: function (modalData) {
            var self = this;

            for (var i = 0; i < self.modalAmount; i++) {
                self.addToCart(modalData);
            }

            self.modalAmount = 1;
        },

        viewProduct: function (product) {
            var self = this;
            //self.modalData = product;
            self.modalData = (JSON.parse(JSON.stringify(product)));
            self.showModal = true;
        },

        changeProductInModal: function (direction) {
            var self = this,
                productsLength = vue.productsData.length,
                currentProduct = self.modalData.sku,
                newProductId,
                newProduct;

            if (direction === "next") {
                newProductId = currentProduct + 1;

                if (currentProduct >= productsLength) {
                    newProductId = 1;
                }

            } else if (direction === "prev") {
                newProductId = currentProduct - 1;

                if (newProductId === 0) {
                    newProductId = productsLength;
                }
            }

            //console.log(direction, newProductId);

            for (var i = 0; i < productsLength; i++) {
                if (vue.productsData[i].sku === newProductId) {
                    self.viewProduct(vue.productsData[i]);
                }
            }
        },

        hideModal: function () {
            //hide modal and empty modal data
            var self = this;
            self.modalData = {};
            self.showModal = false;
        },

        changeImage: function (image) {
            var self = this;
            self.modalData.image = image;
        },

        imageMouseOver: function (event) {
            event.target.style.transform = "scale(2)";
        },

        imageMouseMove: function (event) {
            var self = this;

            event.target.style.transform = "scale(2)";

            self.timeout = setTimeout(function () {
                event.target.style.transformOrigin = ((event.pageX - event.target.getBoundingClientRect().left) / event.target.getBoundingClientRect().width) * 100 + '% ' + ((event.pageY - event.target.getBoundingClientRect().top - window.pageYOffset) / event.target.getBoundingClientRect().height) * 100 + "%";
            }, 50);

            self.mouseStop = setTimeout(function () {
                event.target.style.transformOrigin = ((event.pageX - event.target.getBoundingClientRect().left) / event.target.getBoundingClientRect().width) * 100 + '% ' + ((event.pageY - event.target.getBoundingClientRect().top - window.pageYOffset) / event.target.getBoundingClientRect().height) * 100 + "%";
            }, 100);
        },

        imageMouseOut: function (event) {
            event.target.style.transform = "scale(1)";
        }
    }
}
</script>

<style>
</style>
