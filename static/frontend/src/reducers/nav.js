import {RECEIVE_NAV} from '../constants/ActionTypes';

const initialState =
{
    siteName: '',
    menus: []
};


export default function nav(state = initialState, action) {

    switch (action.type) {
        case RECEIVE_NAV:
            return Object.assign({}, state, action.nav);
            break;
        default:
            return state
    }
}