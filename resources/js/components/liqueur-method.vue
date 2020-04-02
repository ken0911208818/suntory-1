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
                                    <label for="img">蒸餾廠內頁圖片</label>
                                    <input v-if="this.input.edit == null" required type="file" class="form-control" @change="processFile($event)" id="img" name="img" value />
                                    <input v-else type="file" class="form-control" @change="processFile($event)" id="img" name="img" value />
                                    <div class="col-4 pb-0">
                                        <img :src="input.oldimg" alt srcset class="img-fluid" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="title">蒸餾廠內頁標題</label>
                                    <input type="text" class="form-control" v-model="input.title" id="title" name="title" required />
                                </div>
                                <div class="form-group">
                                    <label for="content">蒸餾廠內頁內容</label>
                                    <label for="content" id="warm" style="color: red;margin-left: 5px;" hidden="hidden">請輸入內容！</label>
                                    <vue-editor class="" id="content" name="content" v-model="input.content" :editor-toolbar="customToolbar" @text-change="checkForInput" />
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
                    <h1>酒的蒸餾廠</h1>
                    <v-spacer></v-spacer>
                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field>
                </v-card-title>
                <v-data-table :headers="headers" :items="liqueur_text" :search="search" :items-per-page="10" :loading="false" :dark="isDark" :multi-sort="true">
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
            .post("/admin/liqueurMethod_kind")
            .then(response => (this.liqueur_kind = response.data))
            .catch(function (error) {
                console.log(error);
            });
        //獲取酒的產品
        axios
            .post("/admin/liqueurMethod_text")
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
            liqueur_text: [],
            liqueur_kind: [],
            input: {
                newimg: null,
                oldimg: null,
                content: "",
                title: "",
                liqueur_id: "",
                sort: 0,
                edit: null,
                index: null
            },
            customToolbar: [
                ["bold", "italic", "underline"],
                [{ list: "ordered" }, { list: "bullet" }],
                ["code-block"]
            ],
            headers: [
                { text: '系列', value: 'liqueur.name', align: 'center', },
                { text: '圖片', value: 'img', align: 'center', filterable: false, sortable: false, },
                { text: '標題', value: 'title', align: 'center', },
                { text: '內容', value: 'content', align: 'center', width: "30%" },
                { text: '權重', value: 'sort', align: 'center', filterable: false, sortable: false, },
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
                    .post("/admin/liqueurMethod", {
                        liqueur_id: this.input.liqueur_id,
                        img: this.input.oldimg,
                        content: this.input.content,
                        title: this.input.title,
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
                    .put(`/admin/liqueurMethod/${this.input.edit}`, {
                        liqueur_id: this.input.liqueur_id,
                        img: this.input.oldimg,
                        content: this.input.content,
                        title: this.input.title,
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
                        .delete("/admin/liqueurMethod/" + target.id)
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
                .get(`/admin/liqueurMethod/${target.id}/edit`)
                .then(res => {
                    let {
                        content,
                        img,
                        title,
                        id,
                        liqueur_id,
                        sort
                    } = res.data;
                    this.input.content = content;
                    this.input.title = title;
                    this.input.oldimg = img;
                    this.input.liqueur_id = liqueur_id;
                    this.input.edit = id;
                    this.input.index = index;
                    this.input.sort = sort;
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
                    .post("/admin/liqueurMethod_upload_img", fd)
                    .then(response => (this.input.oldimg = response.data))
                    .catch(function (error) {
                        console.log(error);
                    });
            } else {
                axios
                    .post("/admin/liqueurMethod_delete_img", {
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
                    .post("/admin/liqueurMethod_upload_img", fd)
                    .then(response => (this.input.oldimg = response.data))
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
        //清除表單資料
        clear() {
            this.input.newimg = null,
                this.input.oldimg = "",
                this.input.content = "",
                this.input.title = "",
                this.input.liqueur_id = "",
                this.input.sort = 0,
                this.input.edit = null,
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
