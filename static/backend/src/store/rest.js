import "isomorphic-fetch";
import reduxApi, {transformers} from "redux-api";
import adapterFetch from "../libs/redux-api/adapters/fetch";


const rest = reduxApi({
    app: {
        url: 'app',
        reducer(state, action) {
            initState(state, {siteName: "", menus: []});
            return state;
        }
    },
    posts: {
        url: 'posts',
        reducer(state, action) {
            initState(state, {
                _link: {},
                _meta: {},
                items: []
            });
            return state;
        }
    },
    post: {
        url: 'posts/:id',
        crud: true,
        reducer(state, action) {
            initState(state, {
                title: '',
                id: 0,
                content: '# 标题',
                status: 1,
                created_at: 0,
                updated_at: 0
            });
            return state;
        }
    },
    postStatus:{
        url: 'posts/:id/status/:status',
        virtual: true,
        options: {
            method: "PATCH"
        }
    }
});

function initState(state, data = {}) {
    if (state.data.constructor === Object && Object.keys(state.data).length == 0) {
        state.data = data;
    }
}

rest.use("fetch", adapterFetch(fetch));
rest.use("rootUrl", window.location.protocol + '//' + window.location.hostname + '/backendApi');
rest.use("options", function () {
    const headers = {
        'Accept': 'application/json'
    };
    return {headers: headers};
});

export default rest;