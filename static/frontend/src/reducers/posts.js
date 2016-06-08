import {RECEIVE_POSTS} from '../constants/ActionTypes';

const initialState = [];


export default function posts(state = initialState, action) {

    switch (action.type) {
        case RECEIVE_POSTS:
            return [...state ,...action.posts];
            break;
        default:
            return state
    }

}