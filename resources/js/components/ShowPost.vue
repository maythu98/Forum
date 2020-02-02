<template>
    <div class="container">
        <h1> {{ post.title }} </h1>
        <p> {{post.body}} </p>

        <div class="overall-tags-container">
            <div v-for="tag in post.post_tags" :key="tag.id">
                <span class="little-tag-container"> {{tag.tag.tagName }} </span>
            </div>
        </div>
        
        <!-- Your Feeling -->
        <div class="mt-3">
            <div class="form-group">
                <textarea name="comment" class="form-control" rows="1" placeholder="Add Your Feeling ..." v-model="comment" autofocus></textarea>
            </div>
            <button class="btn btn-primary" @click="saveComment()">Comment</button>
        </div>

        <!-- Other Comments -->
        <div v-for="comment in post.post_comments" :key="comment.id" class="mt-3">
            <label for=""> <b> {{ comment.user.name }} </b>  {{ comment.comment_time }} </label>
            <div>
                {{ comment.comment }}
            </div>
            <hr>
        </div>
    </div>
</template>

<script>
import { log } from 'util';
import { store } from '../store'; 
export default {
    props: ['postID'],
     data() {
        return {
            post: [],
            comment: '',
            token:''
        }
    },
    methods: { 
        showPost() {            
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + store.state.token;
            axios.get('/api/showPost/'+ this.postID).then(response => {
                this.post = response.data;
            });
        },
        saveComment() {
            const data = {};
            data['comment'] = this.comment;
            axios.post('/api/saveComment/' + this.postID, data).then(response => {
                const id = response.data;                
                this.comment = "";
                this.showPost();      
                console.log("Hello");    
                Echo.channel(`comment.${id}`).listen('.App\\Events\\CommentPushEvent', (e) => {
                    console.log("hello");
                });
            }); 
        }
    },
    mounted() {        

        this.showPost();
    }
}
</script>

<style>

</style>