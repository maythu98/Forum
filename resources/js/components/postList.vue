<template>
    <div class="container">
    <div v-for="post in allPosts" :key="post.id" >
    <div class="overall-post-container" :id="'post_'+ post.id">
        <div v-if="user == post.userID" class="btn-group">
            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Small button
            </button>
            
            <div class="dropdown-menu">
                <button class="btn btn-danger" @click="removePost(post.id)">
                    Delete
                </button>Status:In development


                <button class="btn btn-info" @click="callEditData(post.id)">
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
                <span class="little-tag-container"> {{tag.tag.tagName }} </span>
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
import { log } from 'util';
export default {
    props : ['user'],
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
            axios.get('/api/getPosts').then(response=> {
                this.allPosts = response.data;
            });
        },
        removePost(id) {
            axios.post('/removePost/'+ id).then(response=> {
                $(`#post_${id}`).remove()
            })
        },
        callEditData(id) {            
            this.$root.$emit('editPost', id);
        }
    },
    mounted() {
        this.$root.$on('callGetPosts', () => {
            this.getPosts();
        });
        this.getPosts();
    }
}
</script>

<style>

</style>