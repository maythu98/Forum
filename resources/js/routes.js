import CreatePost from "./components/CreatePost";
import ShowPost from "./components/ShowPost";

export default {
    mode : 'history',

    routes: [
        {
            path: '/home',
            name: 'create-post',
            component: CreatePost
        },
        {
            path: '/showPost/:postID',
            name: 'show-post',
            component: ShowPost,
            props: true, 
        }
    ]    
    
}