import {combineReducers} from 'redux';
import load from './load';
import rest from '../store/rest';
const rootReducer = combineReducers(Object.assign({},rest.reducers,{
    load
}));

export default rootReducer