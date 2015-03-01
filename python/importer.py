from gw2lib.webapi import SimpleClient
from pymongo import MongoClient
import datetime

apiv2 = SimpleClient("v2")

# 1. fetch id list
# 2. Filter away ones that already are in DB
# 3. Fetch skin data - preferrably in batch
# 4. Format data to DB
# 5. Save formatted data to DB

BUILD = apiv2.build().id

db = MongoClient()

class SkinFetcher(object):
    # API info : http://wiki.guildwars2.com/wiki/API:2/skins
    api_call = apiv2.dict().skins
    table = db.gw2wardrobe.skins
    
    def __init__(self, batch = 50):
        self.batch = batch

    def is_in_db(self, object_id):
        return self.table.find_one({"skinid": object_id})
    
    def get_id_list(self):
        return [x for x in self.api_call() if not self.is_in_db(x)]
 
    def get_object_data(self, idlist):
        c = 0
        data = []
        partiallist = idlist[c:self.batch]
        while partiallist:
            data.extend(self.api_call(ids=partiallist))
            
            c+=self.batch
            partiallist = idlist[c:self.batch]
        return data   
    
    def prepare_data(self, objdata):
        objdata["added"] = {
            "datetime": datetime.datetime.now(),
            "build": BUILD,
        }
        return objdata
        
    def save_to_db(self, dbdata):
        self.table.insert(dbdata)
        
    def fetch_data(self):
        idlist = self.get_id_list()
        object_data = self.get_object_data(idlist)
        db_data = [self.prepare_data(x) for x in object_data]
        self.save_to_db(db_data)

class ItemFetcher(SkinFetcher):
    # API Info: http://wiki.guildwars2.com/wiki/API:2/items
    api_call = apiv2.dict().items
    table = db.gw2wardrobe.items
    
    def is_in_db(self, object_id):
        return self.table.find_one({"itemid": object_id})
            
if __name__ == "__main__":
    skinfetcher = SkinFetcher()
    itemfetcher = ItemFetcher()
    
    skinfetcher.fetch_data()
    itemfetcher.fetch_data()