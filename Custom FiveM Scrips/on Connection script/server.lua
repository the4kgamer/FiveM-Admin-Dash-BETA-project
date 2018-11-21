AddEventHandler( "playerConnecting", function(name, deferrals)
    if string.find(GetPlayerIdentifiers(source)[1], "steam:") then
        defferals.defer()

        local reason = "kicked because of someone trying to log onto account"
        local time = os.date (os.date('*t'))


        deferrals.update("Checking to see if you are banned, please note you can be denied connection if you have recieved more than 10 reports in the span of 5 mins or less")


        Wait(5000)

        



        --check if user is already un the registered table
        MySQl.Async.fetchAll("Select status FROM registered WHERE identifier = '"..identifier.."'", { ['@identifier'] = identifier}, function (result))
    
            if(result[1] == nil) then
                  


                  --welcome the player if they are new, and adding them into the SQL database
                  
                defferals.update("Welcome new player, we are now adding you into the database")
                Wait(5000)
                MySQl.Async.execute("INSERT INTO registered (identifier) VALUES (@identifier)", { ['identifier'] = identifier})

                
            else
                --welcoming already registered player back into the server
                defferals.update("welcome back " ..identifier.."")
            end
        end)
      
        
        
        --insert into SQL hex and name to connected 
        MySQl.Async.fetchAll("select identifier where identifier = '"..identifier.."'", { ['@identifier'] = identifier}, function (result))
            if(result[1] == nil) then
                --insert them into connected table 
                MySQl.Async.execute("INSERT INTO connected (identifier) VALUES (@identifier)", { ['identifier'] = identifier})

            else
                --if someone with the same identifier is already on their account
                defferals.update("someone with your identifier is already logged on the server, we are kicking them now....")
                MySQl.Async.execute("INSERT into localogs (identifier, reason, time) VALUES (@identifier, @reason, @time)", { ['@identifier' ] = identifier, ['@reason'] = reason, ['@time'] = time})
                DropPlayer(identifier, GetConvar("ban_reason", "you have been kicked as someone is trying to log into the server on your account, if you are positive that this is your account your playing on, change your steam password"))
            end
        end)
       
    
        --check if banned...
        local identifier = getPlayerID(source)
        MySQl.Async.fetchAll("Select status FROM bans WHERE identifier = '"..identifier.."'", { ['@identifier'] = identifier}, function (result))
    
            if(result[1] == nil) then
                defferals.done()
            else
                defferals.done("you have been banned from this server")
            end
        end)

       

        



           
        
    else
        deferals.done("you must have a steam account to play")
    end
end)

AddEventHandler( "playerDropped", function(name)

    

    --remove their steam name and hex from connected users and register leave time
    MySQL.Async.execute("DELETE FROM connected WHERE identifier = @identifier", { ['@identifier'] = identifier})
	end)
	



        

    
function getPlayerID(source)
    local identifiers = GetPlayerIdentifiers(source)
    local player = getIdentifiant(identifiers)
    return player
end
    



