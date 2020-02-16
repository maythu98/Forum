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
        <div v-for="comment in comments" :key="comment.id" class="mt-3">
            <label for=""> <b> {{ comment.user.name }} </b>  {{ comment.comment_time }} </label>
            <div>
                {{ comment.comment }}
            </div>
            <button type="button" class="btn bg-dark text-white"> + </button>
            <button type="button" class="btn bg-dark text-white"> - </button>
            <div>
                <textarea name="replyComment" :id="`replyComment${comment.id}`" class="form-control" cols="30" rows="1" placeholder="Reply...">
                </textarea>
                <button type="submit" class="btn btn-secondary mt-1" @click="saveCommentReply(comment.id)">Reply</button>
            </div>

            <div v-for="sub_comment in comment.sub_comments" :key="sub_comment.id" class="ml-5">
                <label for=""> <b> {{ sub_comment.user.name }} </b>  {{ sub_comment.comment_time }} 
                </label>
                <div>
                    {{ sub_comment.comment }}
                </div>
                <hr>
            </div>
            <hr>
        </div>
    </div>
</template>

<script>
import { store } from '../store'; 
export default {
    props: ['postID'],
     data() {
        return {
            post: [],
            comments: [],
            comment: '',
            token:''
        }
    },
    methods: { 
        showPost() {            
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + store.state.token;
            axios.get('/api/showPost/'+ this.postID).then(response => {                
                this.post = response.data['post'];
                this.comments = response.data['comments'];
            });
        },
    
        saveComment() {
            const data = {};
            data['comment'] = this.comment;
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + store.state.token;
            axios.post('/api/saveComment/' + this.postID, data).then(response => {
                const id = response.data;                
                this.comment = "";
            }); 
        },

        saveCommentReply(id) {
            let comment = $(`#replyComment${id}`).val();
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + store.state.token;
            axios.post('/api/saveReplyComment/' + id, {'comment': comment}).then(response => {
                $(`#replyComment${id}`).val("");
            });
        }
    },
    mounted() {        
        this.showPost();
    },
    created() {
        window.Echo.channel(`comment-channel`).listen('.commentEvent', (data) => {    
            this.comments.unshift(data.comment);
        });    

        
        window.Echo.channel(`subComment-channel`).listen('.subCommentEvent', (data) => {      
            let comment_id = data.reply.post_comment_id;
            let comment = this.comments.filter(comment => comment.id === comment_id);
            comment[0].sub_comments.unshift(data.reply);            
        });  
    }
}
</script>

<style>

</style>