Written by Darnell S., Aug 15, 2014

Copyright 2011 by Darnell S. Redistribution of this file is permitted under the GNU Public License.

Installation
============

Unpack the contents into a web directory
Map the html folder to the public root

Documentation
=============

see http://php-rum.com/

Known Issues
============

Unit Tests can not trace App::sendHttpStatus() calls
ActiveRecord:: associative tables must use the same field names as the relationship tables even if mapping is manually defined
The following ActiveRecord methods do not work when multiple relationships to the same object exist: ActiveRecordBase::removeAssociationsByType()