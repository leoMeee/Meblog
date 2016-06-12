import fecha from  'fecha';

export default function (timestamp, format = 'YYYY-MM-DD hh:mm:ss') {
    return fecha.format(timestamp * 1000, format)
}