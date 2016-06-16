import "isomorphic-fetch";
import reduxApi, {transformers} from "redux-api";
import adapterFetch from "redux-api/lib/adapters/fetch";

const paging = {_link: {}, _meta: {}, items: []};

const rest = reduxApi({
    app: {
        url: 'app',
        reducer(state, action) {
            initState(state, {siteName: "", menus: []});
            return state;
        }
    },
    banner: 'banner',
    posts: {
        url: 'posts',
        reducer(state, action) {
            initState(state, paging);
            return state;
        }
    },
    post: {
        url: 'posts/:id',
        crud: true,
        reducer(state, action) {
            initState(state, {
                'title':'',
                'content':''
            });
            return state;
        }
    }
});

function initState(state, data = {}) {
    if (state.data.constructor === Object && Object.keys(state.data).length == 0) {
        state.data = data;
    }
}

rest.use("fetch", adapterFetch(fetch));
rest.use("rootUrl", window.location.protocol + '//' + window.location.hostname + '/frontendApi');
rest.use("options", function () {
    const headers = {
        'Accept': 'application/json'
    };
    return {headers: headers};
});

export default rest;