/*  */
class Listing
{
    buildImageElement(uri)
    {
        let img = document.createElement('img');
        img.setAttribute('src', uri);
        
        img.style.height = 250+"px";
        img.style.width = (250 * this.getImageRatio(img)) + "px";
        
        return img;
    }
    buildImageHolder()
    {
        let dv = document.createElement('div');
        dv.setAttribute('class', 'listing-image');
        
        return dv;
    }
    getImageRatio(image)
    {
        let height = image.naturalHeight;
        let width = image.naturalWidth;
        
        return width / height;
    }
}

window.addEventListener('load', function(){
    //
    var imageWrapper = document.getElementById('listing-image-wrap');
    
    //  populate image wrapper
    for(let a = 0; a < imageUri.length; a++)
    {
        var listing = new Listing();
        
        imageWrapper.appendChild(listing.buildImageHolder().
                                 appendChild(listing.buildImageElement(imageUri[a])));
    }
});