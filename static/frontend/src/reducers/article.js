import {RECEIVE_ARTICLE} from '../constants/ActionTypes';

const initialState = {
    id: 0,
    title: '',
    content: '',
    created_at: 0,
    updated_at: 0
};


export default function posts(state = initialState, action) {

    switch (action.type) {
        case RECEIVE_ARTICLE:
            return Object.assign({}, state, action.article);
            break;
        default:
            return state
    }
}