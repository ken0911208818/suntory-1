<template>
    <div class="container">
        <a id="add" href="#create" data-toggle="collapse" class="btn btn-success" @click="clear()">新增</a>

        <hr />

        <div class="collapse" id="create">
            <div class="card card-body">
                <form method="post" action="#" enctype="multipart/form-data" id="form1" @submit.prevent="store(input.index)">

                    <div class="form-group">
                        <label for="order_no">訂單編號</label>
                        <input type="text" class="form-control" v-model="input.order_no" id="order_no" name="order_no" required />
                    </div>
                    <div class="form-group">
                        <label for="Recipient_name">收件人姓名</label>
                        <input type="text" class="form-control" v-model="input.Recipient_name" id="Recipient_name" name="Recipient_name" required />
                    </div>
                    <div class="form-group">
                        <label for="Recipient_phone">收件人電話</label>
                        <input type="text" class="form-control" v-model="input.Recipient_phone" id="Recipient_phone" name="Recipient_phone" required />
                    </div>
                    <div class="form-group">
                        <label for="dealer_address">商家地址</label>
                        <input type="text" class="form-control" v-model="input.dealer_address" id="dealer_address" name="dealer_address" required />
                    </div>
                    <div class="form-group">
                        <label for="payment_status">配送狀態</label>
                        <input type="text" class="form-control" v-model="input.payment_status" id="payment_status" name="payment_status" required />
                    </div>
                    <div class="form-group">
                        <label for="totalPrice">總價</label>
                        <input type="number" class="form-control" v-model="input.totalPrice" id="totalPrice" name="totalPrice" />
                    </div>

                    <button type="submit" class="btn btn-primary" data-target="#create">
                        Submit
                    </button>
                </form>
            </div>
            <hr />
        </div>

        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>

                    <th>訂單編號</th>
                    <th>收件人姓名</th>
                    <th>收件人電話</th>
                    <th>商家地址</th>
                    <th>配送狀態</th>
                    <th>總價</th>
                    <th width="80px">action</th>
                </tr>
            </thead>
            <tbody class="tbody">
                <tr v-for="(item, index) in liqueur_text" :key="index">

                    <td>{{ item.order_no }}</td>
                    <td>{{ item.Recipient_name }}</td>
                    <td>{{ item.Recipient_phone }}</td>
                    <td>{{ item.dealer_address }}</td>
                    <td>{{ item.payment_status }}</td>
                    <td>{{ item.totalPrice }}</td>
                    <td>
                        <a href="#create" class="btn btn-success btn-sm" data-toggle="collapse" @click="editdata(index)">修改</a>
                        <button class="btn btn-danger btn-sm" @click="deletedata(index)">
                            刪除
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import FileUpload from "vue-upload-component/src";
import { VueEditor } from "vue2-editor";
export default {
    components: { VueEditor, FileUpload: FileUpload },
    mounted() {
        console.log("Component mounted.");
    },
    props: ["dataAll"],
    created() {
       this.upload();
    },
    data() {
        return {
            files: [],
            liqueur_text: JSON.parse(this.dataAll),
            // liqueur_text:this.dataAll,
            input: {
                totalPrice: "",
                edit: null,
                index: null,
                order_no: "",
                Recipient_name: "",
                Recipient_phone: "",
                dealer_address: "",
                payment_status: "",
            }

        };
    },
    methods: {

        //按下submit
        store(index) {
            if (this.input.edit == null) {
                let {  order_no, Recipient_name, Recipient_phone, dealer_address, payment_status,totalPrice } = this.input;

                axios
                    .post("/admin/Order", {
                        order_no: order_no,
                        Recipient_name: Recipient_name,
                        Recipient_phone: Recipient_phone,
                        dealer_address: dealer_address,
                        payment_status: payment_status,
                        totalPrice:totalPrice
                    })
                    .then(res => {
                        this.clear();
                        this.sweetalert("add");
                        this.liqueur_text.push(res.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            } else {
                //console.log(index);
                let {  order_no, Recipient_name, Recipient_phone, dealer_address, payment_status,totalPrice } = this.input;
                axios
                    .put(`/admin/Order/${this.input.edit}`, {
                        order_no: order_no,
                        Recipient_name: Recipient_name,
                        Recipient_phone: Recipient_phone,
                        dealer_address: dealer_address,
                        payment_status: payment_status,
                        totalPrice:totalPrice
                    })
                    .then(res => {
                        this.sweetalert("edit");
                        this.clear();
                        //兩個方法都可以重新渲染
                        this.$set(this.liqueur_text, index, res.data);
                        // this.liqueur_text.splice(index,1, res.data)
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
        //當頁面讀取完成後執行datatable
        upload() {
            $(document).ready(function () {
                $("#example").DataTable({
                    order: [1, "desc"]
                });
            });
        },
        //刪除
        deletedata(index) {
            //console.log(index);
            let target = this.liqueur_text[index];

            Swal.fire({
                title: `確定要刪除 ${target.title} ?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "確定",
                cancelButtonText: "取消"
            }).then(result => {
                if (result.value) {
                    axios
                        .delete("/admin/Order/" + target.id)
                        .then(res => {
                            this.liqueur_text.splice(index, 1);
                            this.sweetalert("del");
                        })
                        .catch(err => {
                            console.log(err);
                        });
                }
            });
        },
        //讀取編輯資料
        editdata(index) {
            let target = this.liqueur_text[index];


            axios
                .get(`/admin/Order/${target.id}/edit`)
                .then(res => {
                    console.log(res.data);

                     let {  id ,order_no, Recipient_name, Recipient_phone, dealer_address, payment_status,totalPrice } =res.data
                     this.input.order_no= order_no,
                     this.input.Recipient_name= Recipient_name,
                     this.input.Recipient_phone= Recipient_phone,
                     this.input.dealer_address= dealer_address,
                     this.input.payment_status= payment_status,
                     this.input.totalPrice=totalPrice,
                     this.input.edit =id,
                     this.input.index = index
                })
                .catch(err => {
                    console.log(err);
                });


        },
        //清除表單資料
        clear() {
                this.input.order_no = "",
                this.input.Recipient_name = "",
                this.input.Recipient_phone = "",
                this.input.dealer_address = "",
                this.input.payment_status = "",
                this.input.totalPrice = ""
        },

        sweetalert(action) {
            if (action != "del") {
                Swal.fire({
                    icon: "success",
                    title: "儲存成功",
                    timer: 1500
                }).then(result => {
                    $("#add").click();
                });
            } else {
                Swal.fire({
                    icon: "success",
                    title: "刪除成功",
                    timer: 1500
                });
            }
        }
    }
};
</script>
