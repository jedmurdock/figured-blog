<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-body">
                
                        <post-view
                            v-for="(post, index) in posts"
                            v-bind:key="post.id"
                            v-bind:id="post.id"
                            v-bind:title="post.title"
                            v-bind:body="post.body"
                            v-bind:slug="post.slug"
                            v-bind:visible-at="post.visible_at"
                            v-bind:user-id="userId"
                            v-on:delete-post="deletePost(post.slug,index)"
                            >
                        </post-view>
                        
                    </div>
                    <paginate
                        :page-count="pageCount"
                        :click-handler="fetch"
                        :prev-text="'Prev'"
                        :next-text="'Next'"
                        :container-class="'pagination'">
                    </paginate>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['userId', 'apiToken'],

        data() {
            return {
                posts: [],
                pageCount: 1,
                endpoint: 'api/posts?page='
            };
        },

        created() {
            this.fetch();
        },

        methods: {
            fetch(page = 1) {
                axios.get(this.endpoint + page)
                    .then(({data}) => {
                        this.posts = data.data;
                        this.pageCount = data.last_page;
                    });
            },
            deletePost(slug, index){
                axios.delete('api/posts/' + slug, {
                        headers: {
                            Authorization: 'Bearer ' + this.apiToken
                        }
                    })
                    .then(({data}) => {
                        this.posts.splice(index, 1);
                    })
                    .catch(error => {
                        console.log(error.response)
                    });
            }
        }
    }
</script>
