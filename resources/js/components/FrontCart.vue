<template>
    <div>
        <div class="cart">
            <span class="cart-size" @click="showCart = !showCart"> {{ cart | cartSize }} </span>
            <i class="fa fa-shopping-cart" @click="showCart = !showCart"></i>
            <div class="cart-items" v-show="showCart">
                <table class="cartTable">
                    <tbody>
                        <tr class="product" v-for="(product, index) in cart" :key="index">
                            <td class="align-left">
                                <div class="cartImage" @click="removeProduct(product)" v-bind:style="{ backgroundImage: 'url(' + product.image + ')' }" style="background-size: cover; background-position: center;">
                                    <i class="close fa fa-times"></i>
                                </div>
                            </td>
                            <td class="align-center">
                                <button @click="quantityChange(product, 'decriment')">
                                    <i class="close fa fa-minus"></i>
                                </button>
                            </td>
                            <td class="align-center">{{ cart[$index].quantity }}</td>
                            <td class="align-center">
                                <button @click="quantityChange(product, 'incriment')">
                                    <i class="close fa fa-plus"></i>
                                </button>
                            </td>
                            <td class="align-center">{{ cart[$index] | customPluralize }}</td>
                            <td>{{ product.price | currency }}</td>
                    </tbody>
                </table>
            </div>
            <h4 class="cartSubTotal" v-show="showCart"> {{ cartSubTotal | currency }} </h4>
        </div>
        <button class="clearCart" v-show="checkoutBool" @click="clearCart()"> Clear Cart </button>
        <button class="checkoutCart" v-show="checkoutBool" @click="propagateCheckout()"> Checkout </button>'
    </div>
</template>

<script>
export default {
    props: ['checkoutBool', 'cart', 'cartSize', 'cartSubTotal', 'tax', 'cartTotal'],

    data: function () {
        return {
            showCart: false
        }
    },

    filters: {
        customPluralize: function (cart) {
            var newName;

            if (cart.quantity > 1) {
                if (cart.product === "Peach") {
                    newName = cart.product + "es";
                } else if (cart.product === "Puppy") {
                    newName = cart.product + "ies";
                    newName = newName.replace("y", "");
                } else {
                    newName = cart.product + "s";
                }

                return newName;
            }

            return cart.product;
        },

        cartSize: function (cart) {
            var cartSize = 0;

            for (var i = 0; i < cart.length; i++) {
                cartSize += cart[i].quantity;
            }

            return cartSize;
        }
    },

    methods: {
        removeProduct: function (product) {
            vue.cart.$remove(product);
            vue.cartSubTotal = vue.cartSubTotal - (product.price * product.quantity);
            vue.cartTotal = vue.cartSubTotal + (vue.tax * vue.cartSubTotal);

            if (vue.cart.length <= 0) {
                vue.checkoutBool = false;
            }
        },

        clearCart: function () {
            vue.cart = [];
            vue.cartSubTotal = 0;
            vue.cartTotal = 0;
            vue.checkoutBool = false;
            this.showCart = false;
        },

        quantityChange: function (product, direction) {
            var qtyChange;

            for (var i = 0; i < vue.cart.length; i++) {
                if (vue.cart[i].sku === product.sku) {

                    var newProduct = vue.cart[i];

                    if (direction === "incriment") {
                        newProduct.quantity = newProduct.quantity + 1;
                        vue.cart.$set(i, newProduct);

                    } else {
                        newProduct.quantity = newProduct.quantity - 1;

                        if (newProduct.quantity == 0) {
                            vue.cart.$remove(newProduct);

                        } else {
                            vue.cart.$set(i, newProduct);
                        }
                    }
                }
            }

            if (direction === "incriment") {
                vue.cartSubTotal = vue.cartSubTotal + product.price;

            } else {
                vue.cartSubTotal = vue.cartSubTotal - product.price;
            }

            vue.cartTotal = vue.cartSubTotal + (vue.tax * vue.cartSubTotal);

            if (vue.cart.length <= 0) {
                vue.checkoutBool = false;
            }
        },
        //send our request up the chain, to our parent
        //our parent catches the event, and sends the request back down
        propagateCheckout: function () {
            vue.$dispatch("checkoutRequest");
        }
    }
}
</script>

<style>
</style>
