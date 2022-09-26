# Nathan Dugan Devlog

- Used http://www.devside.net/index.html as a quick way to setup a MySQL/PHP environment.
- A bit rusty with PHP, had to get my bearings.
- Initial commit was very very slow, my upload speed isn't that great. I hope that doesn't get counted against me. 
- Fought with my VSC for a bit

### Task #1
- Removed some boilerplate stuff, left some of the page formatting.
- Decided on querying the database for each portion of the task. Should make it more readable.
- Candy:
    - I query the comments containing candy from the database and for each row I echo that within a paragraph tag
- Call Me / Don't call me
    - Same as the candy, I query the comments containing  "call me" and add those to the page via a paragraph tag

- Did similiar queries and steps for referrals and signatures.

- I added tabs for better visualization of the grouping, I know the instructions said to not worry about design, but this was just a simple way of grouping.

- When I got to the "everything else" portion I decided to store the unqiue selectors in a variable so that I could plug them into a 'NOT IN' query to get everything else.


### Task #2
- For this one I know I wanted to grab all the rows that had a date within the comments. I did this by querying rows with '%Ship Date:%' in the comments.
- After that it was a matter of going through each row, grabbing the order id and extracting the date, then updating the shipdate_expected column with the extracted date.
- I got a warning from mySQL stating that the '/' separator is deprecated and I should use '-' instead. So I also did a str_replace to fix that from the extracted dates.

### Feedback
- The candy was a sneaky one, I searched for candy, candies, and random misspellings of candy I could think of. Looking at it again, I found a mention of Laffy Taffy, then it clicked, people probably mentioned specific candy by name. So I went line by line looking at the comments. I found mentions of Bit O Honey, Smarties, and Tootsie Rolls, in addition to the Laffy Taffy. There was a mention of just "taffy" so I'll account for that in my query. I beleive including those in my query should cover them all.
- I can't believe I didn't notice the dates were not correct. For this one, I exploded the date string I extracted and just manually rearranged the date to the correct format
MySql didn't seem to like 'mktime', using MySql's FROM_UNIXTIME made the date slightly off. I imagine this is a timezone issue. Instead of spending too much time on trying to convert
timezones, I just passed in the string I rearranged.
