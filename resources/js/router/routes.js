const Resume = () => import('../views/Resume.vue');
const Resumes = () => import('../views/Resumes.vue');
const Register = () => import('../views/Register.vue');
const Login = () => import('../views/Login.vue');
const NotFound = () => import('../views/NotFound.vue')

export default [
    {
        path: '/',
        redirect: '/resumes'
    },
    {
        path: '/resume',
        component: Resume,
        name: 'home',
    },
    {
        path: '/resumes',
        component: Resumes,
        name: 'resumes'
    },
    {
        path: '/resume/:id',
        props: true,
        component: Resume,
        name: 'resume',
    },
    {
        path: '/register',
        component: Register,
        name: 'register',
        meta : {
            guard : 'guest'
        }
    },
    {
        path: '/login',
        component: Login,
        name: 'login',
        meta : {
            guard : 'guest'
        }
    },
    {
        path: "/:catchAll(.*)",
        name: "NotFound",
        component: NotFound,
    }
];
