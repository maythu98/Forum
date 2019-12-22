<template>
    <div class="container">
    <div v-for="post in allPosts" :key="post.id" >
    <router-link :to="{ name: 'show-post', params: { postID: post.id} }" class="override-default-link">

    <div class="overall-post-container" :id="'post_'+ post.id">
        <div class="overall-post-header">
        <b class="overall-post-title">{{ post.title }}</b> 

        <!-- <div class="btn-group">
            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Small button
            </button>
            <div class="dropdown-menu">
                <button class="btn btn-danger" @click="removePost(post.id)">
                    Delete
                </button>

                <button class="btn btn-info" @click="editPost(post.id)">
                    Update
                </button>
            </div>
        </div> -->

        </div>
        
        <p> {{ post.body.slice(0, 150) }}... </p>

        <div class="overall-tags-container">
            <div v-for="tag in post.post_tags" :key="tag.id">
                <span class="little-tag-container"> {{tag.tagName }} </span>
            </div>
        </div>
        
    </div>

    </router-link>
    </div>

    </div>
</template>

<script>
export default {
     data() {
            return {
                allPosts:{},
            }
        },
    methods: {
        
            getPosts() {
                axios.get('/getPosts').then(response=> {
                    this.allPosts = response.data;
                });
            },
    },
    
        mounted() {
            this.getPosts();
        }
}
</script>

<style>

</style>