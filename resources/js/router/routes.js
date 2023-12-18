const Home = () => import('../views/Home.vue');
const Resume = () => import('../views/Home.vue');
const Resumes = () => import('../views/Resumes.vue');
// const Register = () => import('../views/Register.vue');
// const Login = () => import('../views/Login.vue');

export default [
    {
        path: '/',
        component: Home,
        name: 'home',
    },
    {
        path: '/resumes',
        component: Resumes,
        name: 'resumes'
    },
    {
        path: '/resume/:id',
        component: Resume,
        name: 'resume'
    },
    // {
    //     path: '/register',
    //     component: Register,
    //     name: 'register'
    // },
    // {
    //     path: '/login',
    //     component: Login,
    //     name: 'login'
    // },
];
