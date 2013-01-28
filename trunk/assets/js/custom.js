function zmenstav()
{
    if(document.getElementById('post_published').value == 0)
    {
        document.getElementById('post_published').value = 1;
    }    
    else if(document.getElementById('post_published').value == 1)
    {
        document.getElementById('post_published').value = 0;
    }
}
