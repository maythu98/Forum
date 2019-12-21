<template>
    <div class="container">


        <div class="modal fade" id="createPostModal" tabindex="-1" role="dialog" aria-labelledby="createPostModelLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPostModelLabel" > Create Post </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form ref="createPostForm" @submit.prevent="submit" >
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="title" id="title" name="title" class="form-control" :value="this.postTitle">
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea name="body" id="body" cols="30" rows="10" class="form-control"> 
                                {{this.postBody}} 
                            </textarea>
                        </div>
                    </form>
                    <div class="form-group">
                        <label for="addedTagName">Tags</label>
                        <input id="addedTagName" type="text" class="form-control">
                        <button class="btn btn-secondary" @click="addTags()"> Next </button>
                    </div>

                    <div class="row flex-row">
                        <div class="p-2 bg-light m-2 rounded-pill " v-for="(tagName, tagNumber) in tags" :key="tagNumber">
                            <span class="px-2"> 
                                {{ tagName }} 
                                <button type="button" class="close" aria-label="Close" @click="removeTag(tagNumber)">
                                    <span aria-hidden="true">&times;</span>
                                </button> 
                            </span>
                        </div>
                    </div>
                  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="createPost()">Save changes</button>
                </div>
            </div>
        </div>
        </div>

        <div class="container">
            <div class="row border my-3 p-3 flex-column" v-for="post in allPosts" :id="'post_'+ post.id">
                <b>{{ post.title }}</b>
                <p>{{post.body}}</p>
                
                <div v-for="tag in post.post_tags">
                    <span class="badge badge-pill badge-info text-white"> {{tag.tagName }} </span>
                    
                </div>

                <div>
                    <button class="btn btn-danger" @click="removePost(post.id)">Remove Post</button>

                    <button class="btn btn-info" @click="editPost(post.id)"> Update Post </button>
                </div>
            </div>

        </div>

        <!-- Modal -->
		<!-- <div class="modal fade" :id="'form'+ this.post_id" tabindex="-1" role="dialog" aria-labelledby="edifForm" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-body">
						</div>
						<div class="form-group title">
							<input type="text" name="title" class="form-control title" placeholder="Title" accept="image/*" v-model="EditTitle">
						</div>
						<div class="form-group" v-if="EditLists.length ==0">
							<textarea type="text" rows="5" name="note" class="form-control" v-model="EditNote"></textarea>
						</div>
						<div v-for="list,index in EditLists" class="mb-2 ml-1" v-else>
							<input type="checkbox" :value="list, index" v-model="lists">{{list}}
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal" @click="updatePost(editPost.id)">Close</button>
					</div>
				</div>
				
			</div>
		</div> -->

    </div>
</template>

<script>
import { log } from 'util';
    export default {
        data() {
            return {
                tags: [],
                tagName: '',
                tagId: 0,
                createdPost:{},
                allPosts:{},
                postTitle: '',
                postBody: '',
                postId: 0,
            }
        },
        methods: { 
            createPost() {

                const formData = new FormData(this.$refs['createPostForm']); 
                const data = {};
                
                for (let [key, val] of formData.entries()) {
                    Object.assign(data, { [key]: val })
                }

                data['tags'] = this.tags;

                axios.post('/createPost/' + this.postId, data).then(response=> {
                    this.getPosts();
                    // this.createdPost = response.data;
                    $('#createPostModal').modal('hide');                    
				});		

            },
            getPosts() {
                axios.get('/getPosts').then(response=> {
                    this.allPosts = response.data;
                });
            },
            addTags() {
                this.tags.push($('#addedTagName').val());
                $('#addedTagName').val('').focus();
            },
            removeTag(tagNumber) {
                this.tags.splice(tagNumber,1);
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
