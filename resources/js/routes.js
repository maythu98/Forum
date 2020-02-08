import CreatePost from "./components/CreatePost";
import ShowPost from "./components/ShowPost";
import Register from "./auth/Register";
import LogIn from "./auth/LogIn";

export default {
    mode : 'history',

    routes: [
        {
            path: '/',
            name: 'create-post',
            component: CreatePost
        },
        {
            path: '/showPost/:postID',
            name: 'show-post',
            component: ShowPost,
            props: true, 
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        },
        {
            path: '/login',
            name: 'login',
            component: LogIn,
            props: true
        }
    ]    
    
}