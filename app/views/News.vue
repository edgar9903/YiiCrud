<template>
    <div>
        <router-link to="create">Create News</router-link>
        <news-modal :showModal="showModal"
                    :hideModal="closeModal"
                    :data="data"
        ></news-modal>
        <div class="container">
            <div class="row">
                <div class="col-md-4 p-2" v-for="item in news" >
                    <div class="border p-2 ">
                        <h3 class="text-center ">{{item.name}}</h3>
                        <div class="p-2">
                            <img :src="item.image" class="w-100">
                        </div>
                        <p>{{item.description}}</p>
                        <div class=" mt-2 text-right">
                            <button class="btn btn-outline-warning" @click="toggleodal(item.id)">Update</button>
                            <button class="btn btn-outline-danger" @click="newsDelete(item.id)">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import NewsModal from '../components/modal'

    export default {
        data(){
            return {
                news: {
                    type: Object,
                    default: () => {
                        return {};
                    }
                },
                showModal: false,
                data: {},
            }
        },
        mounted() {

            this.getNews();
        },
        components: {
          NewsModal
        },
        methods: {
            toggleodal(id) {

                axios.post('news/edit/',{
                    id:id
                })
                    .then((response) => {
                        this.data = response.data.result;
                        this.showModal = true;
                    })
                    .catch((error) =>{
                        console.log(error)
                    })
            },
            closeModal(){
                this.showModal = false;
                this.getNews();
            },
            getNews() {
                axios.get('news/')
                    .then((response) => {
                        this.news = response.data.result
                    })
                    .catch((error) =>{
                        console.log(error)
                    })
            },
            newsDelete(id) {
                axios.post('news/delete/',{
                    id:id
                })
                    .then((response) => {
                        this.getNews();
                    })
                    .catch((error) =>{
                        console.log(error)
                    })
            }
        }
    }
</script>
