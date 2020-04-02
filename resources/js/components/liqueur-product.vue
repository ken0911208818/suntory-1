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
                                    <label for="liqueur_id">系列</label>
                                    <select required name="liqueur_id" id="liqueur_id" v-model="input.liqueur_id" class="form-control">
                                        <option v-for="(item, index) in liqueur_kind" :value="item.id" :key="index">{{ item.name }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="img">圖片</label>
                                    <input v-if="this.input.edit == null" required type="file" class="form-control" @change="processFile($event)" id="img" name="img" value />
                                    <input v-else type="file" class="form-control" @change="processFile($event)" id="img" name="img" value />
                                    <div class="col-4 pb-0">
                                        <img :src="input.oldimg" alt srcset class="img-fluid" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="title">名稱</label>
                                    <input type="text" class="form-control" v-model="input.title" id="title" name="title" required />
                                </div>
                                <div class="form-group">
                                    <label for="content">介紹</label>
                                    <label for="content" id="warm" style="color: red;margin-left: 5px;" hidden="hidden">請輸入介紹！</label>
                                    <vue-editor class="" id="content" name="content" v-model="input.content" :editor-toolbar="customToolbar" @text-change="checkForInput" />
                                </div>
                                <div class="form-group">
                                    <label for="capacity">容量</label>
                                    <input required type="text" class="form-control" v-model="input.capacity" id="capacity" name="capacity" />
                                </div>
                                <div class="form-group">
                                    <label for="density">濃度</label>
                                    <input required type="text" class="form-control" v-model="input.density" id="density" name="density" />
                                </div>
                                <div class="form-group">
                                    <label for="price">價錢</label>
                                    <input required type="number" class="form-control" v-model="input.price" id="price" name="price" />
                                </div>
                                <div class="form-group">
                                    <label for="color">色澤</label>
                                    <input required type="text" class="form-control" v-model="input.color" id="color" name="color" />
                                </div>
                                <div class="form-group">
                                    <label for="aroma">香氣</label>
                                    <input required type="text" class="form-control" v-model="input.aroma" id="aroma" name="aroma" />
                                </div>
                                <div class="form-group">
                                    <label for="body">酒體</label>
                                    <input required type="text" class="form-control" v-model="input.body" id="body" name="body" />
                                </div>
                                <div class="form-group">
                                    <label for="taste">味覺</label>
                                    <input required type="text" class="form-control" v-model="input.taste" id="taste" name="taste" />
                                </div>
                                <div class="form-group">
                                    <label for="aftertaste">餘覺</label>
                                    <input required type="text" class="form-control" v-model="input.aftertaste" id="aftertaste" name="aftertaste" />
                                </div>
                                <div class="form-group">
                                    <label for="note">備註</label>
                                    <input type="text" class="form-control" v-model="input.note" id="note" name="note" />
                                </div>
                                <div class="form-group" v-if="input.edit != null">
                                    <label for="sort">權重</label>
                                    <input type="number" class="form-control" v-model="input.sort" id="sort" name="sort" value="0" />
                                </div>
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

                        <v-btn class="mx-2" fab dark small color="black" @click="toggleDark()">
                            <svg class="bi bi-circle-half" width="1rem" height="1rem" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 15V1a7 7 0 000 14zm0 1A8 8 0 108 0a8 8 0 000 16z" clip-rule="evenodd" />
                            </svg>
                        </v-btn>
                    </div>
                    <h1>酒的系列</h1>
                    <v-spacer></v-spacer>
                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field>
                </v-card-title>
                <v-data-table :headers="headers" :items="liqueur_text" :search="search" :items-per-page="10" :loading="false" :dark="isDark" :multi-sort="true" :single-expand="singleExpand" show-expand>
                    <template v-slot:item.img="{ item }">
                        <div class="p-2 d-flex justify-content-center">
                            <v-img :src="item.img" :alt="item.contest" style="max-width:100px;"></v-img>
                        </div>
                    </template>
                    <template v-slot:item.content="{ item }">
                        <p v-html="item.content"></p>
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
                    <template v-slot:expanded-item="{ headers, item }">
                        <td :style="{ color: isDark? 'hsla(0,0%,100%,.7)':'rgba(0,0,0,0.6)' }" :colspan="headers.length">
                            <!-- <div class="row d-flex flex-wrap">
                                <div class="col-6">色澤：{{ item.color }}</div>
                                <div class="col-6">香氣：{{ item.aroma }}</div>
                                <div class="col-6">味覺：{{ item.taste }}</div>
                                <div class="col-6">餘覺：{{ item.aftertaste }}</div>
                                <div class="col-6">酒體：{{ item.body }}</div>
                                <div class="col-6">備註：{{ item.note }}</div>
                            </div> -->
                            <tr>
                                <td> 色澤：{{ item.color }} </td>
                                <td> 香氣：{{ item.aroma }} </td>
                            </tr>
                            <tr>
                                <td> 味覺：{{ item.taste }} </td>
                                <td> 餘覺：{{ item.aftertaste }} </td>
                            </tr>
                            <tr>
                                <td> 酒體：{{ item.body }} </td>
                                <td> 備註：{{ item.note }} </td>
                            </tr>
                        </td>
                    </template>
                </v-data-table>
            </v-card>
        </v-app>
    </div>
</template>

<script>
import axios from "axios";
import { VueEditor } from "vue2-editor";
export default {
    components: { VueEditor },
    mounted() {
        console.log("Component mounted.");
    },
    created() {
        //獲取酒的系列
        axios
            .post("/admin/liqueurProduct_kind")
            .then(response => (this.liqueur_kind = response.data))
            .catch(function (error) {
                console.log(error);
            });
        //獲取酒的產品
        axios
            .post("/admin/liqueurProduct_text")
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
            isDark: false,
            liqueur_kind: [],
            liqueur_text: [],
            input: {
                newimg: null,
                oldimg: null,
                liqueur_id: "",
                title: "",
                content: "",
                capacity: "",
                density: "",
                color: "",
                aroma: "",
                body: "",
                taste: "",
                aftertaste: "",
                price: "",
                note: "",
                sort: 0,
                edit: null,
                index: null
            },
            customToolbar: [
                ["bold", "italic", "underline"],
                [{ list: "ordered" }, { list: "bullet" }],
                ["code-block"]
            ],
            expanded: [],
            singleExpand: false,
            headers: [
                { text: '系列', value: 'liqueur.name', align: 'center', },
                { text: '圖片', value: 'img', align: 'center', filterable: false, sortable: false, },
                { text: '名稱', value: 'title', align: 'center', width: "9%" },
                { text: '介紹', value: 'content', align: 'center', width: "25%" },
                { text: '容量', value: 'capacity', align: 'center', },
                { text: '濃度', value: 'density', align: 'center', },
                { text: '價錢', value: 'price', align: 'center', },
                { text: '權重', value: 'sort', align: 'center', },
                { text: '更多', value: 'data-table-expand', align: 'center' },
                { text: '', value: 'action', align: 'center', filterable: false, sortable: false, },
            ],
        };
    },
    methods: {
        toggleDark() {
            if (this.isDark) {
                $('td').css('color', 'black');
            } else {
                $('td').css('color', 'white');
            }
            this.isDark = !this.isDark
        },
        checkForInput() {//偵測content變化
            if (this.input.content == "") {//未輸入文字
                $('#warm').removeAttr("hidden");
                $('#content').addClass('border border-danger');
            } else {
                $('#warm').attr('hidden', 'hidden');//有輸入文字
                $('#content').removeClass('border border-danger');
            }
        },
        //按下submit
        store(index) {
            if (this.input.content == "") {//content未輸入文字
                $('#warm').removeAttr("hidden");
                $('#content').addClass('border border-danger');
                return;
            }
            $('#staticBackdrop').modal('hide');

            if (this.input.edit == null) {
                axios
                    .post("/admin/liqueurProduct", {
                        liqueur_id: this.input.liqueur_id,
                        img: this.input.oldimg,
                        content: this.input.content,
                        title: this.input.title,
                        capacity: this.input.capacity,
                        density: this.input.density,
                        color: this.input.color,
                        aroma: this.input.aroma,
                        body: this.input.body,
                        taste: this.input.taste,
                        aftertaste: this.input.aftertaste,
                        price: this.input.price,
                        note: this.input.note,
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
                    .put(`/admin/liqueurProduct/${this.input.edit}`, {
                        liqueur_id: this.input.liqueur_id,
                        img: this.input.oldimg,
                        content: this.input.content,
                        title: this.input.title,
                        capacity: this.input.capacity,
                        density: this.input.density,
                        color: this.input.color,
                        aroma: this.input.aroma,
                        body: this.input.body,
                        taste: this.input.taste,
                        aftertaste: this.input.aftertaste,
                        price: this.input.price,
                        note: this.input.note,
                        sort: this.input.sort
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
                        .delete("/admin/liqueurProduct/" + target.id)
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
                .get(`/admin/liqueurProduct/${target.id}/edit`)
                .then(res => {
                    this.input = res.data;
                    this.input.index = index;
                    this.input.edit = res.data.id;
                    this.input.oldimg = res.data.img;
                })
                .catch(err => {
                    console.log(err);
                });
        },
        //判斷是否有圖片上傳
        processFile(event) {
            if (this.input.oldimg == null) {
                this.input.newimg = event.target.files[0];
                const fd = new FormData();
                fd.append("file", this.input.newimg, this.input.newimg.name);
                axios
                    .post("/admin/liqueurProduct_upload_img", fd)
                    .then(response => (this.input.oldimg = response.data))
                    .catch(function (error) {
                        console.log(error);
                    });
            } else {
                axios
                    .post("/admin/liqueurProduct_delete_img", {
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
                    .post("/admin/liqueurProduct_upload_img", fd)
                    .then(response => (this.input.oldimg = response.data))
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
        //清除表單資料
        clear() {
            this.input.newimg = null;
            this.input.oldimg = null;
            this.input.content = "";
            this.input.title = "";
            this.input.liqueur_id = "";
            this.input.capacity = "";
            this.input.density = "";
            this.input.color = "";
            this.input.aroma = "";
            this.input.body = "";
            this.input.taste = "";
            this.input.aftertaste = "";
            this.input.price = "";
            this.input.note = "";
            this.input.sort = "";
            this.input.edit = null;
            this.input.index = null;
            $("#img").val("");
            $('#warm').attr('hidden', 'hidden');
            $('#content').removeClass('border border-danger');
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
