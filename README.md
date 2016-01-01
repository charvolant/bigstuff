# BigStuff Omeka Theme

The BigStuff [Omeka](http://omeka.org/) theme is a theme designed for the home of the Big Stuff large technology
object conferences.

This theme is based on the [Berlin](https://github.com/omeka/theme-berlin) Omeka theme and
uses the highly configurable index page features from Berlin.

## Features

* Features from Berlin
    * Configurable logo image
    * Configurable header image
    * Configurable footer text and copyright
    * Configurable home page text
    * Configurable info boxes, such as a featured item or collection, for the home page.
* Features from BigStuff
    * Customisable background filler image
    * A *hero-shot* image on the home page, selected randomly from items with images in the featured collections.
    * Single-line item lists, which expand on mouse-over, as a configurable option.
    * Citation-style item information. BigStuff is designed to contain collections of conference papers, as well as
    other collections. If given a suitable item type, the item will be provided with a citation.

## Installation and Configuration

Copy the root of this source directory to `$OMEKA/themes/bigstuff` where `$OMEKA` is the root of the Omeka installation
(eg. `/srv/www/htdocs/omeka`).
It should them appear as an avilable theme in the Omeka administration pages.

Once installed, go to the *Appearance* menu in Omeka administration.
You can then configure the theme.

### Citations

The BigStuff theme generates bibliographic citations for items with appropriate item types and information.
These are designed to allow things like papers and publications to be added and browsed.
A short citation, generally either author-title or just the title, depending on the item type, is used as a headline.
A full citation is generated as part of the item summary.

#### Addtional Item Types and Elements



To get full citation information, a number of additional item types and elements need to be added to your site.
These don't need to be added, or can be partially added; the citation generator will omit any information
that it can't find.
The new item types and elements are listed below, with the standard Dublin Core elements ignored.
Elements in **bold** are completely new elements or item types.
Items in *italics* are existing elements that need to be added to item types.

| Type | Description | Elements |
| ---- | ----------- | -------- |
| **Article** | An article in a journal or periodical | **Journal**, *Location*, **Pages**, **Volume**, **Number**, **DOI** |
| **Paper** | A paper presented as part of a conference, workshop, etc. | **Editor**, **Book**, *Location*, **Pages**, **DOI** |
| **Book** | A book, including published collections such as conference proceedings. | **Editor**, *Location*, **Volume**, **Pages**, **ISBN** |
| **Manual** | A technical or procedural manual or set of instructions | **Institution**, **Number**, **DOI** |
| **Thesis** | A PhD or masters thesis | **Location**, **Institution**, **Number**, **DOI** |
| **Report** | A report produced for a specific purpose |  **Institution**, **Number**, **DOI** |
| Text | The standard Omeka text item | **DOI** |
| Website | The standard Omeka website type | |
| Hyperlink | The standard Omeka hyperlink type |
| Moving Image | The standard Omeka moving image type | |
| Still Image | The standard Omeka still image type | |

The additional elements are

| Element | Description |
| ------- | ----------- |
| Journal | The name of the journal |
| Location | Already included in Omeka but used for a publisher's address or conference location |
| Pages | The page or pages where an article, paper or part of a book can be found |
| Volume | The journal or book volume |
| Number | The number of the journal with a volume for a journal. For manuals, reports, etc., the reference number assigned to the document by the creating institution |
| DOI | The [Digital Object Identifier](https://www.doi.org/) for documents with a persistent DOI |
| Editor | The editor of a collection or book |
| Book | The title of the book in which a paper or section has been published |
| ISBN | The [International Standard Book Number](https://www.isbn-international.org/) of a book |


#### Citation Types

Citations are presented differently depending on the *Item Type* of the item, or the Dublin Core *Type* of the collection.
Citations use the following Dublin Core terms:

| Type | Author | Year | Editor | Title | Journal/Proceedings | Publisher | Location | Pages | Volume | Number | Date | Institution | Document Number | URL | DOI/ISBN |
| ---- | ------ | ---- | ------ | ----- | ------------------- | --------- | -------- | ----- | ------ | ------ | ---- | ----------- | --------------- | --- | -------- |
| Article(2) | Creator | Date(1) | | Title | Journal(3) or Collection Title | Publisher or Collection Publisher | Location | Pages(3) | Volume(3) | Number(3) | | | | | DOI(3) |
| Paper(2) | Creator | Date(1) | Editor(3) or Collection Creator | Title | Book or Collection Title | Publisher or Collection Publisher | Location | Pages(3) | | | Date | | | | DOI(3) |
| Book(2) | Creator | Date(1) | Editor(3) | Title | | Publisher | Location | | Volume(3) | | Pages(3) | | | | ISBN(3) |
| Manual(2) | Creator | Date(1) | | Title | | | | | | | | Institution(3) | Number(3) | | DOI(3) |
| Thesis(2) | Creator | Date(1) | | Title | | | Location(3) | | | | | Institution | Number(3) | | DOI(3) |
| Report(2) | Creator | Date(1) | | Title | | | | | | | | Institution(3) | Number(3) | | DOI(3) |
| Text | Creator | | | Title | | Publisher | | | | | Date | | | | DOI(3) |
| Website | | | | Title | | | | | | | Date | | | Local URL or Source | |
| Hyperlink | | | | Title | | | | | | | Date | | | URL | |
| Moving Image | Creator, Director, Producer | Date(1) | | Title |  | Publisher | | | | | | | | | |
| Still Image | Creator | Date(1) | | Title |  | Publisher | | | | | | | | | |
| default | Creator | | | Title | | Publisher | Location | Pages | | | Date | Institution(3) | Number(3) | URL | DOI(3) |


*(1)* Dates are parsed using the PHP `parse_date` function to see if a year can be recognised. In general, use
*mm/dd/yyyy* for US-style dates, *dd-mm-yyyy* or *dd.mm.yyyy* for European-style dates and *yyyy-mm-dd* for ISO-style dates.
Two digit years will be interpreted as *yy-mm-dd* - you have been warned. If a date cannot be parsed, the entire date is used.

*(2)* These item types are not part of the standard set of supplied item types.


*(3)* These would be really useful but don't have a corresponding Dublin Core term. Boo. Hiss. 
Instead, they can be added to the item type metadata associated with the new item types.


#### Inheritance

Journal articles and conference papers can draw some information from the collection that they are in.
In this case the collection is treated as the journal or conference proceedings, with the title of the collection
the title of the journal or conference and the creator of the collection the editor.
For example, an article will get the journal title from the collection title if the Source is not present.

To override this behaviour, put `na` in the item's term (eg. Putting `na` in the Source for an article
means that no journal will be listed).

### Background Images

You can use any repeatable image as a background image.
Three backgrounds are available as part of the theme, all reflecting the technical background to the theme:

* [Gears](images/gears.png)
* [Bluebrint](images/blueprint.png)
* [Old Blueprint](images/blueprint-distorted.png)

There are three 
## Geeks Corner

### Licence

Licenced under the [GPLv3](http://www.gnu.org/licenses/gpl-3.0.en.html).

### Building the Theme

If you feel like modyfiying the theme, the CSS is generated by [Compass](http://compass-style.org/)/[SCSS](http://sass-lang.com/).
You will need to install Compass before generating CSS; follow the instructions on the
Compass page and then find out where gem has put the compass command.

To modify the the CSS modify the SCSS files found in `css/scss` and then run compass.
On the command line, change to the source directory and run compass with the following command:
`$COMPASS/bin/compass compile css` where `$COMPASS` is where-ever gem has decided to put Compass
(eg. `/usr/lib64/ruby/gems/2.1.0/gems/compass-1.0.3`).

### Citation Styles

Citation styles follow the Australian Government Style Manual (6th ed.) as far
as is possible.
If you want to change the way citations are presented, edit `functions.php`.
