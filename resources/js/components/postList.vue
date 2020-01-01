<template>
    <div class="container">
    <div v-for="post in allPosts" :key="post.id" >

    <div class="overall-post-container" :id="'post_'+ post.id">
        <div class="btn-group">
            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Small button
            </button>
            <div class="dropdown-menu">
                <button class="btn btn-danger" @click="removePost(post.id)">
                    Delete
                </button>Status:In development


                <button class="btn btn-info" @click="editPost(post.id)">
                    Update
                </button>
            </div>
        </div>
        <router-link :to="{ name: 'show-post', params: { postID: post.id} }" class="override-default-link">

        <div class="overall-post-header">

        <b class="overall-post-title">{{ post.title }}</b> 

        </div>
        
        <p> {{ post.body.slice(0, 150) }}... </p>
        </router-link>

        <div class="overall-tags-container">
            <div v-for="tag in post.post_tags" :key="tag.id">
                <span class="little-tag-container"> {{tag.tagName }} </span>
            </div>
        </div>

        <!-- <button class="btn btn-danger" @click="removePost(post.id)">
            Delete
        </button>
        
        <button class="btn btn-info" @click="editPost(post.id)">
            Update
        </button> -->
        
    </div>

    </div>

    </div>
</template>

<script>
export default {
     data() {
        return {
            allPosts:{},
            tags: [],
            tagName: '',
            tagId: 0,
            createdPost:{},
            post: {'title': ''},
            postTitle: '',
            postBody: '',
            postId: 0,
        }
    },
    methods: {
        getPosts() {
            axios.get('/getPosts').then(response=> {
                this.allPosts = response.data;
            });
        },
        removePost(id) {
            axios.post('/removePost/'+ id).then(response=> {
                $(`#post_${id}`).remove()
            })
        },
        editPost(id) {
            axios.get('/editPost/'+id).then(response=> {                    
                const post = response.data[0]; 
                this.tags = response.data[1];
                this.post.title = post.title;
                this.postTitle = post.title;
                this.postBody = post.body;
                this.postId = post.id;
                $('#createPostModal').modal();
            });
        }
    },
    
        mounted() {
            this.getPosts();
        }
}
</script>

<style>

</style>