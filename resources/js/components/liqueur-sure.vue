<template>
    <div class="container">
        <v-app>
            <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header v-toolbar v-toolbar--dense v-toolbar--flat grey d-flex align-center">
                            <h5 v-if="this.input.edit == null" class="modal-title" id="staticBackdropLabel">新增</h5>
                            <h5 v-else class="modal-title" id="staticBackdropLabel">編輯</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="clear()">
                                <span aria-hidden="true">X</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" id="form1" @submit.prevent="store(input.index)">
                                <div class="form-group">
                                    <label for="liqueur_product_id">得獎的酒</label>
                                    <select required name="liqueur_product_id" id="liqueur_product_id" v-model="input.liqueur_product_id" class="form-control">
                                        <option v-for="(item, index) in liqueur_products" :value="item.id" :key="index">{{ item.title }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="img">比賽Logo</label>
                                    <input v-if="this.input.edit == null" required type="file" class="form-control" @change="processFile($event)" id="img" name="img" value />
                                    <input v-else type="file" class="form-control" @change="processFile($event)" id="img" name="img" value />
                                    <div class="col-4 pb-0">
                                        <img :src="input.oldimg" alt srcset class="img-fluid" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="contest">比賽名稱</label>
                                    <input type="text" class="form-control" v-model="input.contest" id="contest" name="contest" required />
                                </div>
                                <div class="form-group">
                                    <label for="year">得獎時間(年)</label>
                                    <input type="number" class="form-control" v-model="input.year" id="year" name="year" required />
                                </div>
                                <div class="form-group">
                                    <label for="award">獎項</label>
                                    <input type="text" class="form-control" v-model="input.award" id="award" name="award" required />
                                </div>
                                <!-- <div class="form-group" v-if="input.edit != null">
                                <label for="sort">權重</label>
                                <input type="number" class="form-control" v-model="input.sort" id="sort" name="sort" value="0" />
                            </div> -->
                                <br>
                                <v-btn class="mx-2" fab dark small color="blue" type="submit">儲存</v-btn>
                                <v-btn class="mx-2" fab dark small color="gray" data-dismiss="modal" @click="clear()">取消</v-btn>
                                <br>
                                <br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <v-card>
                <v-card-title class="v-toolbar v-toolbar--dense v-toolbar--flat grey lighten-1">
                    <div class="d-flex justify-content-end mr-3">
                        <v-btn class="mx-2" fab dark small color="blue" data-toggle="modal" data-target="#staticBackdrop" @click="clear()">
                            新增
                        </v-btn>

                        <v-btn class="mx-2" fab dark small color="black" @click="darks()">
                            <svg class="bi bi-circle-half" width="1rem" height="1rem" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 15V1a7 7 0 000 14zm0 1A8 8 0 108 0a8 8 0 000 16z" clip-rule="evenodd" />
                            </svg>
                        </v-btn>
                    </div>
                    <h1>酒的肯定</h1>
                    <v-spacer></v-spacer>
                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field>
                </v-card-title>
                <v-data-table :headers="headers" :items="liqueur_text" :search="search" :items-per-page="10" :loading="false" :dark="dark" :multi-sort="true">
                    <template v-slot:item.index="{ item }">
                        {{liqueur_text.indexOf(item)+1}}
                    </template>
                    <template v-slot:item.img="{ item }">
                        <div class="p-2 d-flex justify-content-center">
                            <v-img :src="item.img" :alt="item.contest" style="max-width:100px;"></v-img>
                        </div>
                    </template>
                    <template v-slot:item.action="{ item }">
                        <div class="d-flex justify-content-center my-3">
                            <v-btn class="mx-2" fab dark small color="green" @click="editdata(liqueur_text.indexOf(item))" data-toggle="modal" data-target="#staticBackdrop">
                                編輯
                            </v-btn>
                            <v-btn class="mx-2" fab dark small color="pink" @click="deletedata(liqueur_text.indexOf(item))">
                                刪除
                            </v-btn>
                        </div>
                    </template>
                </v-data-table>
            </v-card>
        </v-app>
    </div>
</template>

<script>
import axios from "axios";
export default {
    mounted() {
        console.log("Component mounted.");
    },
    created() {
        //獲取酒的產品
        axios
            .post("/admin/liqueurSure_product")
            .then(response => (this.liqueur_products = response.data))
            .catch(function (error) {
                console.log(error);
            });
        //獲取酒的肯定
        axios
            .post("/admin/liqueurSure_text")
            .then(response => {
                this.liqueur_text = response.data;
            })
            .catch(function (error) {
                console.log(error);
            });
    },
    data() {
        return {
            search: '',
            dark: false,
            liqueur_text: [],
            liqueur_products: [],
            input: {
                newimg: null,
                oldimg: null,
                contest: "",
                liqueur_product_id: "",
                year: "",
                award: "",
                // sort: 0,
                edit: null, //若有值則為編輯，若無為新增
                index: null //編輯或刪除第幾項
            },
            customToolbar: [
                ["bold", "italic", "underline"],
                [{ list: "ordered" }, { list: "bullet" }],
                ["code-block"]
            ],
            headers: [
                { text: 'No.', value: 'index', align: 'center', filterable: false, sortable: false, },
                { text: '得獎的酒', value: 'liqueur_product.title', align: 'center', },
                { text: '比賽Logo', value: 'img', align: 'center', filterable: false, sortable: false, },
                { text: '比賽名稱', value: 'contest', align: 'center', },
                { text: '得獎時間(年)', value: 'year', align: 'center', },
                { text: '獎項', value: 'award', align: 'center', },
                // { text: '權重', align: 'center', },
                { text: '', value: 'action', align: 'center', filterable: false, sortable: false, },
            ],
        };
    },
    methods: {
        darks() {
            if (this.dark) {
                $('td').css('color', 'black');
            } else {
                $('td').css('color', 'white');
            }
            this.dark = !this.dark
        },
        //按下submit
        store(index) {
            $('#staticBackdrop').modal('hide');

            if (this.input.edit == null) {
                axios
                    .post("/admin/liqueurSure", {
                        img: this.input.oldimg,
                        contest: this.input.contest,
                        liqueur_product_id: this.input.liqueur_product_id,
                        year: this.input.year,
                        award: this.input.award,
                        sort: 0
                    })
                    .then(res => {
                        this.sweetalert("add");
                        this.liqueur_text.unshift(res.data);
                        this.clear();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            } else {
                axios
                    .put(`/admin/liqueurSure/${this.input.edit}`, {
                        img: this.input.oldimg,
                        contest: this.input.contest,
                        liqueur_product_id: this.input.liqueur_product_id,
                        year: this.input.year,
                        award: this.input.award
                    })
                    .then(res => {
                        this.sweetalert("edit");
                        //兩個方法都可以重新渲染
                        this.$set(this.liqueur_text, index, res.data);
                        // this.liqueur_text.splice(index,1, res.data)
                        this.clear();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
        //刪除
        deletedata(index) {
            //console.log(index);
            let target = this.liqueur_text[index];

            Swal.fire({
                title: `確定要刪除第 ${index + 1} 筆?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "確定",
                cancelButtonText: "取消"
            }).then(result => {
                if (result.value) {
                    axios
                        .delete("/admin/liqueurSure/" + target.id)
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
                .get(`/admin/liqueurSure/${target.id}/edit`)
                .then(res => {
                    //console.log(res.data);
                    let {
                        id,
                        img,
                        contest,
                        liqueur_product_id,
                        year,
                        award
                        // sort
                    } = res.data;
                    this.input.index = index;
                    this.input.edit = id;
                    this.input.oldimg = img;
                    this.input.contest = contest;
                    this.input.liqueur_product_id = liqueur_product_id;
                    this.input.year = year;
                    this.input.award = award;
                    // this.input.sort = sort;
                    // console.log(res.data)
                })
                .catch(err => {
                    console.log(err);
                });
        },
        // onButtonClick(item) {
        //     this.editdata(item);
        // },
        //判斷是否有圖片上傳
        processFile(event) {
            if (this.input.oldimg == null) {
                this.input.newimg = event.target.files[0];
                const fd = new FormData();
                fd.append("file", this.input.newimg, this.input.newimg.name);
                axios
                    .post("/admin/liqueurSure_upload_img", fd)
                    .then(response => (this.input.oldimg = response.data))
                    .catch(function (error) {
                        console.log(error);
                    });
            } else {
                axios
                    .post("/admin/liqueurSure_delete_img", {
                        file_link: this.input.oldimg
                    })
                    .then(function (response) {
                        //console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                this.input.newimg = event.target.files[0];
                const fd = new FormData();
                fd.append("file", this.input.newimg, this.input.newimg.name);
                axios
                    .post("/admin/liqueurSure_upload_img", fd)
                    .then(response => (this.input.oldimg = response.data))
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
        //清除表單資料
        clear() {
            (this.input.newimg = null),
                (this.input.oldimg = ""),
                (this.input.contest = ""),
                (this.input.liqueur_product_id = ""),
                (this.input.year = ""),
                (this.input.award = ""),
                (this.input.edit = null),
                (this.input.index = null);
            $("#img").val("");
        },

        sweetalert(action) {
            if (action != "del") {
                Swal.fire({
                    icon: "success",
                    title: "儲存成功",
                    timer: 1500
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
