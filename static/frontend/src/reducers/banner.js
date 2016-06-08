import {RECEIVE_BANNER} from '../constants/ActionTypes';

const initialState = {
    img: "",
    user: {
        name: '',
        avatar: '',
        say: ''
    }
};


export default function banner(state = initialState, action) {

    switch (action.type) {
        case RECEIVE_BANNER:
            return Object.assign({}, state, action.banner);
            break;
        default:
            return state
    }
}